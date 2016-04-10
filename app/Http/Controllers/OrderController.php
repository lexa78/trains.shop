<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreateInvoice;
use App\Commands\SendEmailWithCheckedDocs;
use App\Commands\SendEmailWithInvoices;
use App\Commands\SendWithTanksForOrder;
use App\Commands\SendWithTanksForServiceOrder;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreOrder;
use App\Http\Requests\StoreServiceOrder;
use App\Models\Document;
use App\Models\Firm;
use App\Models\Order;
use App\Models\Price;
use App\Models\ProductCart;
use App\Models\ProductsInOrder;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\ServiceStatus;
use App\Models\Stantion;
use App\Models\Status;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Bus;
use DateTime;
use DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;
use PhpSpec\Exception\Exception;
use Redirect;
use Route;
use Session;
use Validator;
use View;

class OrderController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['showOrdersToAdmin', 'changeStatus', 'sendCheckedDocuments',
            'showServiceOrdersToAdmin', 'showServiceSpecificOrderToAdmin', 'showSpecificOrderToAdmin']]);
        $this->middleware('admin', ['only'=>['showOrdersToAdmin', 'changeStatus', 'sendCheckedDocuments',
            'showServiceOrdersToAdmin', 'showServiceSpecificOrderToAdmin', 'showSpecificOrderToAdmin']]);
    }

    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function confirm($userID)
	{
		if(Auth::user()->id == (int) $userID) {
			$products = ProductCart::with('product','price.stantion')->where('user_id',$userID)->get();
		} else {
			return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
		}

		$productsArr = [];
		foreach($products as $productCart) {
			//dd($productCart->product);
			$productsArr[$productCart->price->stantion[0]->stantion_name][] = [
				'product_name' => $productCart->product->name,
				'product_amount' => $productCart->product_count,
				'product_price' => $productCart->price->price
			];
		}

		$userCompany = User::with('firm')->where('id',$userID)->get();

		return view('orders.confirmOrder', ['p'=>'confirm', 'userID'=>$userID, 'products'=>$productsArr, 'firm'=>$userCompany[0]->firm]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
        $validationRules = [
            'oferta' => 'accepted',
            'userID'=>'integer|required|in:'.Auth::user()->id,
        ];

        $v = Validator::make($request->all(), $validationRules);

        if ($v->fails())
        {
            return redirect()->route('confirmOrder', ['user_id'=>Auth::user()->id])->withErrors($v->errors());
//            $newRequest = Request::create('confirmOrder/'.Auth::user()->id, 'POST', [], [], [], [],['blat'=>$v->errors()]);
//            return Route::dispatch($newRequest)->getContent();
        }

        $userID = $request->userID;

		if(Auth::user()->id == (int) $userID) {

            $productsByDepoArr = [];
            $newProductsByDepoArr = [];
            $orderNumbers = [];

			DB::transaction(function()
				use($userID, &$productsByDepoArr, &$orderNumbers, &$newProductsByDepoArr)
			{
                $products = ProductCart::with('product.condition','price.stantion')->where('user_id',$userID)->get();

                foreach($products as $productCart) {
                    $productsByDepoArr[$productCart->price->stantion[0]->id][] = [
                        $productCart->product->name.'( состояние - '.$productCart->product->condition->condition.')',
                        $productCart->product_count,
                        $productCart->price->price,
                        $productCart->price->id,
                        $productCart->product->id,
//добавление stantion_name в products_in_order
                        $productCart->price->stantion[0]->stantion_name,
//добавление nds в products_in_order
                        $productCart->price->nds,
                    ];
                    $productCart->price->amount -= $productCart->product_count;
                    $productCart->price->save();
                }

                $userCompany = User::with('firm')->where('id',$userID)->first();

				$status = Status::where('is_first',Order::IS_FIRST)->first();

                foreach($productsByDepoArr as $depoID => $productsArr) {
                    $order = new Order();
                    $order->status_id = $status->id;
                    $order->user_id = $userID;
                    $order->firm_id = $userCompany->firm->id;
                    $order->email = Auth::user()->email;
                    $order->save();
                    $orderNumbers[] = $order->id;

                    foreach($productsArr as $product) {
                        $productsInOrder = new ProductsInOrder();
                        $productsInOrder->order_id = $order->id;
                        $productsInOrder->product_name = $product[0];
                        $productsInOrder->product_price = $product[2];
                        $productsInOrder->product_amount = $product[1];
                        $productsInOrder->stantion_id = $depoID;
                        $productsInOrder->price_id = $product[3];
                        $productsInOrder->product_id = $product[4];
                        $productsInOrder->stantion_name = $product[5];
                        $productsInOrder->nds = $product[6];
                        $productsInOrder->save();
                    }
                    $newProductsByDepoArr[$order->id] = $productsArr;
                    //Запускаем команду на формирование счета
                    Bus::dispatch(new CreateInvoice($order, Stantion::find($depoID)));
                }

				ProductCart::where('user_id',$userID)->delete();
			});

            $files = Document::where('user_id',Auth::user()->id)->where(
                function($query) use($orderNumbers) {
                    foreach($orderNumbers as $number) {
                        $query->orWhere('file_name', 'like', '%'.Order::getDocTypeName(Order::INVOICE_TYPE).'_'.$number.'_%');
                    }
                })->get();

            $fileNames = [];
            foreach($files as $file) {
                $fileNames[] = $file->file_name;
            }

            $messageParams = [];
            $messageParams['productByDepoWithOrderIdAsKey'] = $newProductsByDepoArr;
//            //Запускаем команду на отправку email
            Bus::dispatch(new SendEmailWithInvoices($messageParams, $fileNames));
//            Bus::dispatch(new SendWithTanksForOrder($messageParams));

			return view('orders.success',['p'=>'purchases', 'ordersAmount'=>count($productsByDepoArr)]);
		} else {
			return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
		}
	}

    public function showOrdersToAdmin($newOnly=false)
    {
        if($newOnly) {
            $orders = Order::with('products_in_order.stantion','status','firm')->where('is_new',1)->get();
            return view('orders.showOrdersToAdmin',['orders'=>$orders, 'newOnly'=>$newOnly]);
        } else {
            $orders = Order::latest('created_at')->with('products_in_order.stantion','status','firm')->get();
            return view('orders.showOrdersToAdmin',['orders'=>$orders, 'newOnly'=>$newOnly]);
        }
    }

    public function showFilteredOrdersToAdmin(Request $request)
    {
        $firmId = (int)$request->customer_firm;
        if( ! $firmId) {
            return redirect('fatal_error')->with('alert-danger','Запрашиваемой организации не найдено');
        }
        $firm = Firm::find($firmId);
        $orders = Order::latest('created_at')->with('products_in_order.stantion','status','firm')
                ->where('firm_id',$firmId)
                ->get();
        return view('orders.showOrdersToAdmin',['orders'=>$orders, 'newOnly'=>false, 'firm'=>$firm->organisation_name]);
    }

    public function showServiceOrdersToAdmin($newOnly=false)
    {
        if($newOnly) {
            $orders = ServiceOrder::with('service_status','firm')->where('is_new',1)->get();
            return view('orders.showServiceOrdersToAdmin',['orders'=>$orders, 'newOnly'=>$newOnly]);
        } else {
            $orders = ServiceOrder::latest('created_at')->with('service_status','firm')->get();
            return view('orders.showServiceOrdersToAdmin',['orders'=>$orders, 'newOnly'=>$newOnly]);
        }
    }

    public function showServiceFilteredOrdersToAdmin(Request $request)
    {
        $firmId = (int)$request->customer_firm;
        if( ! $firmId) {
            return redirect('fatal_error')->with('alert-danger','Запрашиваемой организации не найдено');
        }
        $firm = Firm::find($firmId);

        $orders = ServiceOrder::latest('created_at')->with('service_status','firm')
                ->where('firm_id',$firmId)
                ->get();
        return view('orders.showServiceOrdersToAdmin',['orders'=>$orders, 'newOnly'=>false, 'firm'=>$firm->organisation_name]);
    }

    public function showOrders()
    {
        $orders = Order::latest('created_at')->with('products_in_order', 'status')->where('user_id',Auth::user()->id)->get();
        $serviceOrders = ServiceOrder::latest('created_at')->with('service_status')->where('user_id',Auth::user()->id)->get();;
        return view('orders.showOrders',['p'=>'cabinet', 'orders'=>$orders, 'serviceOrders'=>$serviceOrders]);
    }

    public function showSpecificOrderToAdmin($orderId)
    {
        $order = Order::with('products_in_order.stantion', 'status', 'firm')->where('id',$orderId)->first();
        $statuses = Status::all();
        if($order->is_new == 1) {
            $order->is_new = 0;
            $order->save();
        }

        $documents = Document::where('order_id',$orderId)->orderBy('type')->get();
        $documentTypes = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

        return view('orders.showSpecificOrderToAdmin',['order'=>$order, 'statuses'=>$statuses,
            'documents'=>$documents, 'documentTypes'=>$documentTypes]);
    }

    public function showServiceSpecificOrderToAdmin($orderId)
    {
        $order = ServiceOrder::with('service_status', 'firm')->where('id',$orderId)->first();
        $statuses = ServiceStatus::all();
        if($order->is_new == 1) {
            $order->is_new = 0;
            $order->save();
        }

        $documents = Document::where('service_order_id',$orderId)->orderBy('type')->get();
        $documentTypes = [1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5];

        return view('orders.showServiceSpecificOrderToAdmin',['order'=>$order, 'statuses'=>$statuses,
            'documents'=>$documents, 'documentTypes'=>$documentTypes]);
    }

    public function showSpecificOrder($orderId, $userId, $orderType)
    {
        if(Auth::user()->id == (int) $userId) {
            if($orderType == Order::DOCUMENT_FOR_SPARE_PART) {
                $order = Order::with('products_in_order.stantion', 'status')->where('id',$orderId)->first();
                $documents = Document::where('user_id', Auth::user()->id)->where('order_id',$orderId)->get();
                return view('orders.showSpecificOrder',[
                    'p'=>'cabinet',
                    'order'=>$order,
                    'documents'=>$documents
                ]);
            } else {
                $order = ServiceOrder::with('service_status')->where('id',$orderId)->first();
                $documents = Document::where('user_id', Auth::user()->id)->where('service_order_id',$orderId)->get();
                return view('orders.showServiceSpecificOrder',[
                    'p'=>'cabinet',
                    'order'=>$order,
                    'documents'=>$documents
                ]);
            }
        } else {
            return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
        }
    }

    public function changeStatus($statusId, $orderId, $is_service = 0)
    {
        $response = 0;
        try {
            DB::transaction(function()
            use($statusId, $orderId, &$response, $is_service) {
                if($is_service) {
                    $order = ServiceOrder::where('id', $orderId)->first();
                    $order->service_status_id = $statusId;
                    $order->save();
                    $response = 1;
                } else {
                    if ($statusId == Order::CANCELED) {
                        $order = Order::with('products_in_order.price')->where('id', $orderId)->first();
                        foreach ($order->products_in_order as $product) {
                            $product->price->amount += $product->product_amount;
                            $product->price->save();
                        }
//                    $response = Order::CANCELED;
                    } else {
                        $order = Order::where('id', $orderId)->first();
//                    if($statusId == Order::COMPLETED) {
//                        $response = Order::COMPLETED;
//                    } else {
//                        $response = 1;
//                    }
                    }
                    $order->status_id = $statusId;
                    $order->save();
                    $response = 1;
                }
            });
        } catch(Exception $e) {
            $response = 0;
        }
        dd($response);
        echo $response;
    }

	public function confirmServiceOrder($serviceId)
	{
        try{
            $service = Service::findOrFail($serviceId);
        } catch(ModelNotFoundException $e) {
            abort(404);
        }

        return view('orders.confirmServiceOrder', ['service' => $service, 'firm' => Auth::user()->firm, 'p' => 'purchases']);
	}

	public function storeServiceOrder(ServiceOrder $serviceOrder, StoreServiceOrder $request)
	{
        $status = ServiceStatus::where('is_first',Order::IS_FIRST)->first();
        $user = Auth::user();
        $service = Service::find($request->service_id);
        $serviceOrder->service_status_id = $status->id;
        $serviceOrder->user_id = $user->id;
        $serviceOrder->firm_id = $user->firm->id;
        $serviceOrder->service_name = $service->short_name;
        $serviceOrder->service_price = $service->price;
        $serviceOrder->more_info = $request->more_info;
        if($request->need_station) {
            $serviceOrder->station_names = $request->station_names;
        }
        $serviceOrder->save();
        $messageParams['service'] = $serviceOrder;
        Bus::dispatch(new SendWithTanksForServiceOrder($messageParams));
        return view('orders.serviceSuccess',['p'=>'purchases', 'serviceName'=>$service->short_name]);
	}

	public function sendCheckedDocuments(Request $request)
	{
		$documentIds = json_decode($request->value);
        $documents = Document::whereIn('id',$documentIds)->get();
        $fileNames = [];
        $orderId = 0;
        $userId = 0;
        foreach($documents as $document) {
            $fileNames[] = ['type'=>$document->type, 'fName'=>$document->file_name];
        }
        $orderId = $document->order_id ? $document->order_id : $document->service_order_id;
        $userId = $document->user_id;
        $resOfSend = Bus::dispatch(new SendEmailWithCheckedDocs($fileNames, $orderId, $userId));
        if($resOfSend == Utils::STR_SUCCESS) {
            foreach($documents as $document) {
                $document->sended = 1;
                $document->save();
            }
            //return redirect()->back()->with('alert-success','Документы отправлены заказчику.');
            echo 'success';
        } else {
            //return redirect()->back()->with('alert-danger','Ошибка отправки документов.');
            echo 'danger';
        }
	}

}

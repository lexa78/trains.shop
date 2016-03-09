<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreateInvoice;
use App\Commands\SendEmailWithInvoices;
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
            $orderNumbers = [];

			DB::transaction(function()
				use($userID, &$productsByDepoArr, &$orderNumbers)
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
                        $productsInOrder->save();
                    }
                    //Запускаем команду на формирование счета
//                    Bus::dispatch(new CreateInvoice($order, Stantion::find($depoID)));
                }

				ProductCart::where('user_id',$userID)->delete();
			});

//            $files = Document::where('user_id',Auth::user()->id)->where(
//                function($query) use($orderNumbers) {
//                    foreach($orderNumbers as $number) {
//                        $query->orWhere('file_name', 'like', '%'.Order::getDocTypeName(Order::INVOICE_TYPE).'_'.$number.'_%');
//                    }
//                })->get();
//
//            $fileNames = [];
//            foreach($files as $file) {
//                $fileNames[] = $file->file_name;
//            }

//            $messageParams = [];
//            $messageParams['productByDepoAsKey'] = $productsByDepoArr;
//            //Запускаем команду на отправку email
//            Bus::dispatch(new SendEmailWithInvoices($messageParams, $fileNames));

			return view('orders.success',['p'=>'purchases', 'ordersAmount'=>count($productsByDepoArr)]);
		} else {
			return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
//	public function invoice($orderNumber, $depoName, $look)
//	{
//		$selfFirmUser = User::with('firm')->where('role_id',1)->first();
//
//		$order = Order::where('id',$orderNumber)->first();
//		$userCompany = User::with('firm')->where('id',$order->user_id)->first();
//
//		$products = unserialize($order->products);
//		$firm = $userCompany->firm;
//
//		$productsArr = [];
//		foreach($products as $productCart) {
//            if($depoName == $productCart->price->stantion[0]->stantion_name) {
//                $productsArr[$depoName][] = [
//                    'product_name' => $productCart->product->name,
//                    'product_amount' => $productCart->product_count,
//                    'product_price' => $productCart->price->price
//                ];
//            }
//		}
//
//		$date = DateTime::createFromFormat('Y-m-d H:i:s', $order->updated_at);
//		$date = strtotime($date->format('d F Y'));
//
//		$pdf = App::make('dompdf.wrapper');
//		$pdf->loadView('test',[
//            'orderNumber'=>$order->id,
//            'orderDate'=>date('d.m.Y',$date),
//            'firm'=>$firm,
//            'selfFirm'=>$selfFirmUser->firm,
//            'products'=>$productsArr,
//            'depoName'=>$depoName
//        ]);
//		//$pdf->save('invoices/invoice.pdf');
//		if($look) {
//			return $pdf->stream();
//		} else {
//			return $pdf->download('invoice.pdf');
//		}
//
////		$selfFirmUser = User::with('firm')->where('role_id',1)->first();
////
////  //      $file = 'invoice.pdf';
////
////		$pdf = App::make('dompdf.wrapper');
//////		$pdf->loadHTML('');
////		$pdf->loadView('test',['orderNumber'=>5864, 'firm'=>$firm, 'selfFirm'=>$selfFirmUser->firm]);
//////		$view =  View::make('test',['orderNumber'=>5864])->render();
//////		$pdf->loadHTML($view);
////	//	return $pdf->download('invoice.pdf');
////   //     file_put_contents($file, $view);
//////        $pdf->loadFile('C:\OpenServer\domains\trains.shop\public\invoices\invoice.html');
////		return $pdf->stream();
//////		return $pdf->save();
////	//	dd($view);
//	}

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

    public function showOrders()
    {
        $orders = Order::latest('created_at')->with('products_in_order', 'status')->where('user_id',Auth::user()->id)->get();
        return view('orders.showOrders',['p'=>'cabinet', 'orders'=>$orders]);
    }

    public function showSpecificOrderToAdmin($orderId)
    {
        $order = Order::with('products_in_order.stantion', 'status', 'firm')->where('id',$orderId)->first();
        $statuses = Status::all();
        if($order->is_new == 1) {
            $order->is_new = 0;
            $order->save();
        }
        return view('orders.showSpecificOrderToAdmin',['order'=>$order, 'statuses'=>$statuses]);
    }

    public function showServiceSpecificOrderToAdmin($orderId)
    {
        $order = ServiceOrder::with('service_status', 'firm')->where('id',$orderId)->first();
        $statuses = ServiceStatus::all();
        if($order->is_new == 1) {
            $order->is_new = 0;
            $order->save();
        }

        $documents = Document::where('service_order_id',$orderId)->get();
//        $documentsAsArr = [];
//        foreach($documents as $document) {
//
//        }

        return view('orders.showServiceSpecificOrderToAdmin',['order'=>$order, 'statuses'=>$statuses, 'documents'=>$documents]);
    }

    public function showSpecificOrder($orderId, $userId)
    {
        if(Auth::user()->id == (int) $userId) {
            $order = Order::with('products_in_order.stantion', 'status')->where('id',$orderId)->first();

//            $document = Document::where('user_id', Auth::user()->id)->where('order_id',$orderId)->first();
//            if(! $document) {
//                return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
//            }
//            $fileName = explode(DIRECTORY_SEPARATOR,$document->file_name);
//            $fileName = end($fileName);
//            $typeOfDoc = Order::getDocTypeName($document->type, true);
//
//            $shownFileName = $typeOfDoc.' № '. $document->order_id;
            return view('orders.showSpecificOrder',[
                                                    'p'=>'cabinet',
                                                    'order'=>$order,
//                                                    'shortFileName' => $fileName,
//                                                    'shownFileName' => $shownFileName,
                                                ]);
        } else {
            return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
        }
    }

    public function changeStatus($statusId, $orderId)
    {
        $response = 0;
        try {
            DB::transaction(function()
            use($statusId, $orderId, &$response) {
                if($statusId == Order::CANCELED) {
                    $order = Order::with('products_in_order.price')->where('id', $orderId)->first();
                    foreach($order->products_in_order as $product) {
                        $product->price->amount += $product->product_amount;
                        $product->price->save();
                    }
                    $response = Order::CANCELED;
                } else {
                    $order = Order::where('id', $orderId)->first();
                    if($statusId == Order::COMPLETED) {
                        $response = Order::COMPLETED;
                    } else {
                        $response = 1;
                    }
                }
                $order->status_id = $statusId;
                $order->save();
            });
        } catch(Exception $e) {
            $response = 0;
        }
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
        //todo нужно ли отправлять письмо и создавать документы?
        return view('orders.serviceSuccess',['p'=>'purchases', 'serviceName'=>$service->short_name]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

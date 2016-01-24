<?php namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Firm;
use App\Models\Order;
use App\Models\ProductCart;
use App\Models\ProductsInOrder;
use App\Models\Status;
use App\Models\User;
use DateTime;
use DB;
use Illuminate\Http\Request;
use Auth;
use Session;
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

		return view('orders.confirmOrder', ['userID'=>$userID, 'products'=>$productsArr, 'firm'=>$userCompany[0]->firm]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($userID)
	{
		if(Auth::user()->id == (int) $userID) {

            $productsByDepoArr = [];

			DB::transaction(function()
				use($userID, &$productsByDepoArr)
			{
                $products = ProductCart::with('product.year','product.condition','product.factory','price.stantion')->where('user_id',$userID)->get();

                foreach($products as $productCart) {
                    $productsByDepoArr[$productCart->price->stantion[0]->id][] = [
                        $productCart->product->name.'( состояние - '.$productCart->product->condition->condition
                        .', завод - ('.$productCart->product->factory->factory_code.')'
                        .$productCart->product->factory->factory_name
                        .', год выпуска - '.$productCart->product->year->year.')',
                        $productCart->product_count,
                        $productCart->price->price
                    ];
                    $productCart->price->amount -= $productCart->product_count;
                    $productCart->price->save();
                }
                $userCompany = User::with('firm')->where('id',$userID)->first();

				$status = Status::where('is_first',1)->first();

                foreach($productsByDepoArr as $depoID => $productsArr) {
                    $order = new Order();
                    $order->status_id = $status->id;
                    $order->user_id = $userID;
                    $order->firm_id = $userCompany->firm->id;
                    $order->email = Auth::user()->email;
                    $order->save();
                    foreach($productsArr as $product) {
                        $productsInOrder = new ProductsInOrder();
                        $productsInOrder->order_id = $order->id;
                        $productsInOrder->product_name = $product[0];
                        $productsInOrder->product_price = $product[2];
                        $productsInOrder->product_amount = $product[1];
                        $productsInOrder->stantion_id = $depoID;
                        $productsInOrder->save();
                    }
                }

				ProductCart::where('user_id',$userID)->delete();
			});

            /*
             * todo Поставить в очередь создание счетов по заказам
             * todo Поставить в очередь на отправку письмо заказчику с созданными счетами
             */
			return view('orders.success',['ordersAmount'=>count($productsByDepoArr)]);
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
	public function invoice($orderNumber, $depoName, $look)
	{
		$selfFirmUser = User::with('firm')->where('role_id',1)->first();

		$order = Order::where('id',$orderNumber)->first();
		$userCompany = User::with('firm')->where('id',$order->user_id)->first();

		$products = unserialize($order->products);
		$firm = $userCompany->firm;

		$productsArr = [];
		foreach($products as $productCart) {
            if($depoName == $productCart->price->stantion[0]->stantion_name) {
                $productsArr[$depoName][] = [
                    'product_name' => $productCart->product->name,
                    'product_amount' => $productCart->product_count,
                    'product_price' => $productCart->price->price
                ];
            }
		}

		$date = DateTime::createFromFormat('Y-m-d H:i:s', $order->updated_at);
		$date = strtotime($date->format('d F Y'));

		$pdf = App::make('dompdf.wrapper');
		$pdf->loadView('test',[
            'orderNumber'=>$order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
            'depoName'=>$depoName
        ]);
		//$pdf->save('invoices/invoice.pdf');
		if($look) {
			return $pdf->stream();
		} else {
			return $pdf->download('invoice.pdf');
		}

//		$selfFirmUser = User::with('firm')->where('role_id',1)->first();
//
//  //      $file = 'invoice.pdf';
//
//		$pdf = App::make('dompdf.wrapper');
////		$pdf->loadHTML('');
//		$pdf->loadView('test',['orderNumber'=>5864, 'firm'=>$firm, 'selfFirm'=>$selfFirmUser->firm]);
////		$view =  View::make('test',['orderNumber'=>5864])->render();
////		$pdf->loadHTML($view);
//	//	return $pdf->download('invoice.pdf');
//   //     file_put_contents($file, $view);
////        $pdf->loadFile('C:\OpenServer\domains\trains.shop\public\invoices\invoice.html');
//		return $pdf->stream();
////		return $pdf->save();
//	//	dd($view);
	}

    public function showOrders()
    {
        $orders = Order::latest('created_at')->with('products_in_order.stantion', 'status')->where('user_id',Auth::user()->id)->get();
        return view('orders.showOrders',['orders'=>$orders]);
    }

    public function showSpecificOrder($orderId, $userId)
    {
        if(Auth::user()->id == (int) $userId) {
            $order = Order::with('products_in_order.stantion', 'status')->where('id',$orderId)->first();
            return view('orders.showSpecificOrder',['order'=>$order]);
        } else {
            return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
        }
    }
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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

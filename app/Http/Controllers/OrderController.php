<?php namespace App\Http\Controllers;

use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Firm;
use App\Models\Order;
use App\Models\ProductCart;
use App\Models\Status;
use App\Models\User;
use DateTime;
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
			dd($products->toArray());
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

		$nextOrderId = Order::max('id') + 1;

		Session::put('products', $products);
		Session::push('company', $userCompany[0]->firm);

		return view('orders.confirmOrder', ['userID'=>$userID, 'products'=>$productsArr, 'firm'=>$userCompany[0]->firm, 'nextOrderId'=>$nextOrderId]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProductCart $products, Firm $firm, Order $order, $userID)
	{
		/*
		 * todo Не очищается сессия. Не срабатывает Session::forget('products');
		 * временно поставил $firm[0]
		 */

		if(Auth::user()->id == (int) $userID) {
			$products = Session::get('products');
			$firm = Session::get('company');
			Session::forget('products');
			Session::forget('company');

			$status = Status::where('is_first',1)->first();

			$order->status_id = $status->id;
			$order->products = serialize($products);
			$order->user_id = $userID;
			$order->firm = $firm[0]->organisation_name;
			$order->contact_face = $firm[0]->contact_face_fio;
			$order->phone = $firm[0]->phone;
			$order->email = Auth::user()->email;
			$order->save();

			ProductCart::where('user_id',$userID)->delete();

			return view('orders.success', ['orderNumber'=>$order->id]);
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
	public function invoice($orderNumber,$look)
	{
		$selfFirmUser = User::with('firm')->where('role_id',1)->first();

		$order = Order::where('id',$orderNumber)->first();
		$userCompany = User::with('firm')->where('id',$order->user_id)->first();

		$products = unserialize($order->products);
		$firm = $userCompany->firm;

		$productsArr = [];
		foreach($products as $productCart) {
			$productsArr[$productCart->price->stantion[0]->stantion_name][] = [
				'product_name' => $productCart->product->name,
				'product_amount' => $productCart->product_count,
				'product_price' => $productCart->price->price
			];
		}

		$date = DateTime::createFromFormat('Y-m-d H:i:s', $order->updated_at);
		$date = strtotime($date->format('d F Y'));

		$pdf = App::make('dompdf.wrapper');
		$pdf->loadView('test',['orderNumber'=>$order->id, 'orderDate'=>date('d.m.Y',$date), 'firm'=>$firm, 'selfFirm'=>$selfFirmUser->firm, 'products'=>$productsArr]);
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
<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCart;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductCartController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(ProductCart $cart)
	{
		if(Auth::guest()) {
			$productCartArr = [];
			$totalSum = 0;
			$userID = 0;
		} else {
			$userID = Auth::user()->id;
			$productCart = $cart->with('price.stantion','product')->where('user_id', Auth::user()->id)->get();
			$productCartArr = [];
			$totalSum = 0;

			foreach($productCart as $item) {
				$price = $item->price->price;

				$productCartArr[$item->price->stantion[0]->stantion_name][] = [
					'name'=>$item->product->name,
					'price'=>$price,
					'id'=>$item->id,
					'amount'=>$item->product_count,
				];
				$totalSum += $price * $item->product_count;
			}
			unset($productCart);
		}

		return view('productCart.index',['productCartArr'=>$productCartArr, 'totalSum'=>$totalSum, 'userID'=>$userID]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ProductCart $productCart, Request $request)
	{
		if(Auth::user()->id == $request->user_id) {
			$presentProducts = $productCart->where('product_id',$request->product_id)->where('price_id',$request->price_id)->get();
			if(count($presentProducts)) {
				$presentProducts[0]->product_count += (int) $request->amount;
				$presentProducts[0]->save();
			} else {
				$productCart->user_id = (int) $request->user_id;
				$productCart->product_id = (int) $request->product_id;
				$productCart->price_id = (int) $request->price_id;
				$productCart->product_count = (int) $request->amount;
				$productCart->save();
			}
		} else {
			return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
		}

		return redirect()->back()->with('alert-success', 'Товар добавлен в корзину');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
	public function update(Request $request, $id)
	{
		try{
			$productCartItem = ProductCart::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			return redirect('fatalError');
		}
		$productCartItem->product_count = $request->value;
		$productCartItem->save();

		//echo 'обновлен';
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
//		$productCart = ProductCart::find($id);
//		dd($productCart);
//		$productCart->delete();
		ProductCart::destroy($id);
		return back()->with('alert-success','Товар удален');
	}

}

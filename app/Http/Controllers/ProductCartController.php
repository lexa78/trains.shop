<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Price;
use App\Models\Product;
use App\Models\ProductCart;
use DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductCartController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth',['except'=>'index']);
		$this->middleware('general',['only'=>'index']);
	}

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

		return view('productCart.index',['p'=>'productCart','productCartArr'=>$productCartArr, 'totalSum'=>$totalSum, 'userID'=>$userID]);
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
			DB::transaction(function() use($request, $productCart){
					//Товаров в наличии
				$price = Price::with('product')->where('id',$request->price_id)->first();
				$productAmount = $price->amount;
				$productName = $price->product[0]->name;
				if($productAmount < (int)$request->amount) {
					return redirect()->back()->with('alert-danger', 'Товар '.$productName.' не может быть добавлен в корзину, т.к. его количество в депо '.$productAmount.'шт., а вы хотите добавить в корзину'.$request->amount.' шт.');
				}
				//Есть ли уже в корзине этот товар (который только что добавили)
				$presentProducts = $productCart->where('product_id',$request->product_id)->where('price_id',$request->price_id)->get();
				if(count($presentProducts)) {
					if($productAmount < (int)$request->amount + $presentProducts[0]->product_count) {
						return redirect()->back()->with('alert-danger', 'Товар '.$productName.' не может быть добавлен в корзину, т.к. его количество в депо '.$productAmount.'шт., в корзине '.$presentProducts[0]->product_count.'шт., и вы хотите добавить в корзину еще '.$request->amount.'шт.');
					}
					$presentProducts[0]->product_count += (int) $request->amount;
					$presentProducts[0]->save();
				} else {
					$productCart->user_id = (int) $request->user_id;
					$productCart->product_id = (int) $request->product_id;
					$productCart->price_id = (int) $request->price_id;
					$productCart->product_count = (int) $request->amount;
					$productCart->save();
				}
//				$price->amount -= (int) $request->amount;
//				$price->save();
			});
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
//		try{
//			$productCartItem = ProductCart::findOrFail($id);
//		} catch(ModelNotFoundException $e) {
//			return redirect('fatalError');
//		}
//		$productCartItem->product_count = $request->value;
//		$productCartItem->save();

		try{
			$productCartItem = ProductCart::findOrFail($id);
			$price = Price::with('product')->where('id',$productCartItem->price_id)->first();
			$currentAmount = $price->amount;
		} catch(ModelNotFoundException $e) {
			return redirect('fatalError');
		}
		DB::transaction(function() use($id, $price, $productCartItem, $request, &$currentAmount) {
			if((int)$currentAmount >= (int)$request->value) {
//				$price->amount -= (int) $request->value;
//				$price->save();
				$productCartItem->product_count = $request->value;
				$productCartItem->save();
				$currentAmount = 0;
			}
		});
		echo $currentAmount;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
//		$price = null;
//		DB::transaction(function() use($id, &$price) {
//			$productCart = ProductCart::find($id);
//			$price = Price::with('product')->where('id',$productCart->price_id)->first();
//			$price->amount += $productCart->product_count;
//			$price->save();
//			$productCart->delete();
//		});

		ProductCart::destroy($id);
//		return back()->with('alert-success','Товар '.$price->product[0]->name.' удален');
		return back()->with('alert-success','Товар удален');
	}

}

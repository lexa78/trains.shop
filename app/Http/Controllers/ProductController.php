<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Factory;
use App\Models\Price;
use App\Models\Product;
use App\Models\Stantion;
use App\Models\TrainRoad;
use App\MyDesigns\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use App\Models\Year;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class ProductController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$products = Product::with('year','factory')->get();
//dd($products);
		return view('products.index',['products'=>$products]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Factory $factory, Year $year, Condition $condition, Category $category, TrainRoad $trainRoad)
	{
		$factories = $factory->all();
		$years = $year->orderBy('year','desc')->get();
		$conditions = $condition->all();
		$categories = $category->all();
		$trainRoads = $trainRoad->with('stantion')->get();

		return view('products.create',['product'=>null, 'factories'=>$factories, 'factoryID'=>null, 'years'=>$years,
					'yearID'=>null, 'conditions'=>$conditions, 'conditionID'=>null, 'categories'=>$categories,
					'categoryID'=>null, 'trainRoads'=>$trainRoads, 'pricesArr'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Product $product, Request $request)
	{
		//$id = $request->route('products');
		//dd($id);
		$validationRules = [
			'name' => 'required|alpha_spaces_numbers|max:35|unique:products',
			'article' => 'required|alpha_spaces_numbers|max:15',
			'description' => 'required|alpha_spaces_numbers',
			'year_id' => 'required|integer',
			'factory_id' => 'required|integer',
			'condition_id' => 'required|integer',
		];

		$depos = Stantion::all();
		foreach($depos as $depo) {
			$validationRules['price'.$depo->id] = 'required|numeric';
			$validationRules['amount'.$depo->id] = 'required|numeric';
		}

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

		DB::transaction(function()
			use($product, $request,$depos)
		{
			$product->article = $request->article;
			$product->name = $request->name;
			$product->description = $request->description;
			$product->year_id = $request->year_id;
			$product->factory_id = $request->factory_id;
			$product->condition_id = $request->condition_id;
			if( ! (int)$request->category_id) {
				$product->category_id = null;
			} else {
				$product->category_id = $request->category_id;
			}
			$product->save();

			$priceIdArr =[];
			foreach($depos as $depo) {
				$price = new Price();
				$priceInputName = 'price'.$depo->id;
				$priceInputAmount = 'amount'.$depo->id;
				$price->price = $request->$priceInputName;
				$price->amount = $request->$priceInputAmount;
				$price->save();

				$depo->price()->attach($price->id);
				$priceIdArr[] = $price->id;
			}
			$product->price()->sync($priceIdArr);
		});

		return redirect('products')->with('alert-success', 'Товар успешно добавлен!');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id, ProductRepositoryInterface $productFromRepository)
	{
		try{
			$product = Product::with(['price', 'price.stantion'])->where('id', $id)->first();
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		if(!$product) {
			abort(404);
		}

		if($product->category_id) {
			$productParams = $productFromRepository->getProductProperties($id, true);
		} else {
			$productParams = $productFromRepository->getProductProperties($id, false);
		}

		$prices = $product->price;

		$pricesArr = [];
		foreach($prices as $price) {
			$pricesArr[$price->stantion[0]->train_road->tr_name][] = [
				'stantion_name' => $price->stantion[0]->stantion_name,
				'price' => $price->price,
				'amount' => $price->amount,
			];
		}
		unset($prices);

		return view('products.show',['productParams'=>$productParams, 'prices'=>$pricesArr, 'product'=>$product]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit(Factory $factory, Year $year, Condition $condition, Category $category, TrainRoad $trainRoad, $id)
	{
		try{
			$product = Product::with(['price', 'price.stantion', 'price.stantion.train_road'])->where('id', $id)->first();
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		if(!$product) {
			abort(404);
		}

		$factories = $factory->all();
		$years = $year->orderBy('year','desc')->get();
		$conditions = $condition->all();
		$categories = $category->all();

		$prices = $product->price;

		$pricesArr = [];
		foreach($prices as $price) {
			$pricesArr[$price->stantion[0]->train_road->id][$price->stantion[0]->train_road->tr_name][] = [
				'stantion_name' => $price->stantion[0]->stantion_name,
				'stantion_id' => $price->stantion[0]->id,
				'price' => $price->price,
				'amount' => $price->amount,
			];
		}
		unset($prices);

		return view('products.edit',['product'=>$product, 'factories'=>$factories, 'factoryID'=>$product->factory_id, 'years'=>$years,
			'yearID'=>$product->year_id, 'conditions'=>$conditions, 'conditionID'=>$product->condition_id, 'categories'=>$categories,
			'categoryID'=>$product->category_id, 'id'=>$product->id, 'prices'=>$pricesArr]);
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
			$product = Product::with(['price', 'price.stantion'])->where('id', $id)->first();
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		if(! $product) {
			abort(404);
		}

		$id = $request->route('products');

		$validationRules = [
			'name' => 'required|alpha_spaces_numbers|max:35|unique:products,name,'.$id,
			'article' => 'required|alpha_spaces_numbers|max:15',
			'description' => 'required|alpha_spaces_numbers',
			'year_id' => 'required|integer',
			'factory_id' => 'required|integer',
			'condition_id' => 'required|integer',
		];

		$depos = Stantion::all();
		foreach($depos as $depo) {
			$validationRules['price'.$depo->id] = 'required|numeric';
			$validationRules['amount'.$depo->id] = 'required|numeric';
		}

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

		$prices = $product->price;

		DB::transaction(function()
		use($product, $request,$prices)
		{
			$product->article = $request->article;
			$product->name = $request->name;
			$product->description = $request->description;
			$product->year_id = $request->year_id;
			$product->factory_id = $request->factory_id;
			$product->condition_id = $request->condition_id;
			if( ! (int)$request->category_id) {
				$product->category_id = null;
			} else {
				$product->category_id = $request->category_id;
			}
			$product->save();

			foreach($prices as $price) {
				$priceInputName = 'price'.$price->stantion[0]->id;
				$priceInputAmount = 'amount'.$price->stantion[0]->id;
				$price->price = $request->$priceInputName;
				$price->amount = $request->$priceInputAmount;
				$price->save();
			}
		});

		return redirect('products')->with('alert-success','Товар обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$product = Product::with(['price'])->where('id', $id)->first();
		DB::transaction(function()
		use($product) {
				$product->price()->detach();
				foreach($product->price as $price) {
					$price->delete();
				}
				$product->delete();
			}
		);
		return back()->with('alert-success','Товар '. $product->name .' удален');
	}

}

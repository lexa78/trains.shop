<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\TrainRoad;
use DB;
use Validator;
use App\Models\Price;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ServiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$services = Service::all();

		return view('services.index',['services'=>$services]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$trainRoads = TrainRoad::all();
		return view('services.create',['service'=>null, 'trainRoads'=>$trainRoads, 'pricesArr'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Service $service, Request $request)
	{
		//$id = $request->route('products');
		//dd($id);
		$validationRules = [
			'short_name' => 'required|alpha_spaces_numbers_etc|max:255|unique:services',
			'full_name' => 'required|alpha_spaces_numbers_etc',
			'unit' => 'required|alpha_spaces_numbers_etc|max:50',
			'period' => 'required|alpha_spaces_numbers_etc|max:100',
			'documents' => 'required|alpha_spaces_numbers_etc',
		];

		$trainRoads = TrainRoad::all();
		foreach($trainRoads as $trainRoad) {
			$validationRules['price'.$trainRoad->id] = 'required|numeric';
		}

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors());
		}
		DB::transaction(function()
		use($service, $request,$trainRoads)
		{
			$service->short_name = $request->short_name;
			$service->full_name = $request->full_name;
			$service->unit = $request->unit;
			$service->period = $request->period;
			$service->documents = $request->documents;
			$service->save();

			foreach($trainRoads as $trainRoad) {
				$price = new Price();
				$priceInputName = 'price'.$trainRoad->id;
				$price->price = $request->$priceInputName;
				$price->tr_id = $trainRoad->id;
				$price->service_id = $service->id;
				$price->save();
			}
		});

		return redirect('services')->with('alert-success', 'Услуга успешно добавлена!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		try{
			$service = Service::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$prices = Price::where('service_id','=',$service->id)->get();

		$trainRoadsTemp = TrainRoad::all();
		$trainRoads = [];
		foreach($trainRoadsTemp as $trainRoadTemp) {
			$trainRoads[$trainRoadTemp->id] = $trainRoadTemp->tr_name;
		}
		unset($trainRoadsTemp, $trainRoadTemp);

		return view('services.show',['service'=>$service, 'prices'=>$prices, 'trainRoads'=>$trainRoads]);

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try{
			$service = Service::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$trainRoads = TrainRoad::all();

		$prices = Price::where('service_id','=',$service->id)->get();

		$pricesArr = [];
		foreach($prices as $price) {
			$pricesArr[$price->tr_id] = $price->price;
		}

		return view('services.edit',['service'=>$service, 'trainRoads'=>$trainRoads, 'id'=>$service->id,
			'pricesArr'=>$pricesArr, 'prices'=>$prices]);
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
			$service = Service::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$id = $request->route('services');

		$validationRules = [
			'short_name' => 'required|alpha_spaces_numbers_etc|max:255|unique:services,short_name,'.$id,
			'full_name' => 'required|alpha_spaces_numbers_etc',
			'unit' => 'required|alpha_spaces_numbers_etc|max:50',
			'period' => 'required|alpha_spaces_numbers_etc|max:100',
			'documents' => 'required|alpha_spaces_numbers_etc',
		];

		$trainRoads = TrainRoad::all();
		foreach($trainRoads as $trainRoad) {
			$validationRules['price'.$trainRoad->id] = 'required|numeric';
		}

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors());
		}
		DB::transaction(function()
		use($service, $request,$trainRoads)
		{
			$service->short_name = $request->short_name;
			$service->full_name = $request->full_name;
			$service->unit = $request->unit;
			$service->period = $request->period;
			$service->documents = $request->documents;
			$service->save();

			$prices = Price::where('service_id',$service->id)->get();
			foreach($prices as $price) {
				//$price = new Price();
				$priceInputName = 'price'.$price->tr_id;
				$price->price = $request->$priceInputName;
				//$price->tr_id = $price->tr_id;
				//$price->product_id = $product->id;
				$price->save();
			}
		});

		return redirect('services')->with('alert-success','Услуга обновлена');

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$service = Service::find($id);
		$service->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Услуга '. $service->short_name .' удалена');
	}

}

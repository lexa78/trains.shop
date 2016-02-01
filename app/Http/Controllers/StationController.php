<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Price;
use App\Models\Product;
use App\Models\Stantion;
use App\Models\TrainRoad;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StationController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$stations = Stantion::all();
		return view('stations.index',['stations'=>$stations]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(TrainRoad $trainRoad)
	{
		$trainRoads = $trainRoad->all();

		return view('stations.create',['stationName'=>null, 'trainRoads'=>$trainRoads, 'trID'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Stantion $depo, Product $product, StoreStation $request)
	{
		$products = $product->all();
		DB::transaction(function()
			use($depo, $request, $products)
				{
					$lastInsertedDepo = $depo -> create($request->all());
					$pricesIdArr = [];
					foreach($products as $prod) {
						$price = new Price();
						$price->price = 0;
						$price->save();

						$prod->price()->attach($price->id);
						$pricesIdArr[] = $price->id;
					}
					$lastInsertedDepo->price()->sync($pricesIdArr);
				}
		);

		return redirect('stations')->with('alert-warning', 'Депо успешно добавлено! Внимание! Не забудьте проставить цену товарам для этого депо');
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
			$station = Stantion::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$tRoadName = $station->train_road->tr_name;

		return view('stations.show',['station'=>$station, 'tRoadName'=>$tRoadName]);
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
			$station = Stantion::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$tRoads = TrainRoad::all();

		return view('stations.edit',['stationName'=>$station->stantion_name, 'id'=>$station->id, 'trainRoads'=>$tRoads , 'trID'=>$station->train_road_id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreStation $request, $id)
	{
		try{
			$station = Stantion::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$station->update($request->all());
		$station->save();
		return redirect('stations')->with('alert-success','Станция обновлена');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//$station = Stantion::find($id);
		$station = Stantion::with(['price'])->where('id', $id)->first();
		DB::transaction(function()
		use($station) {
			$station->price()->detach();
			foreach($station->price as $price) {
				$price->delete();
			}
			$station->delete();
		});
		//Region::destroy($id);
		return back()->with('alert-success','Станция '. $station->stantion_name .' удалена');
	}

}

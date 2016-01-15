<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Region;
use App\Models\Stantion;
use App\Models\TrainRoad;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTrainRoads;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TrainRoadsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tRoads = TrainRoad::all();
		return view('trainRoads.index',['tRoads'=>$tRoads]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Region $region)
	{
		$regions = $region->all();

		return view('trainRoads.create',['tRoadName'=>null, 'regions'=>$regions, 'regID'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(TrainRoad $trainRoad, StoreTrainRoads $request)
	{
		$trainRoad -> create($request->all());
		return redirect('trainRoads')->with('alert-success', 'Железная дорога успешно добавлена!');
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
			$tRoad = TrainRoad::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$regionName = $tRoad->region->reg_name;

		return view('trainRoads.show',['tRoad'=>$tRoad, 'regionName'=>$regionName]);
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
			$tRoad = TrainRoad::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$regions = Region::all();

		return view('trainRoads.edit',['tRoadName'=>$tRoad->tr_name, 'id'=>$tRoad->id, 'regions'=>$regions, 'regID'=>$tRoad->region_id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreTrainRoads $request, $id)
	{
		try{
			$tRoad = TrainRoad::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$tRoad->update($request->all());
		$tRoad->save();
		return redirect('trainRoads')->with('alert-success','Железная дорога обновлена');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$tRoad = TrainRoad::find($id);
		$tRoad->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Железная дорога '. $tRoad->tr_name .' удалена');
	}

}

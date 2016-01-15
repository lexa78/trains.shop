<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Http\Requests\StoreRegion;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$regions = Region::all();
		return view('regions.index',['regions'=>$regions]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('regions.create',['regName'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Region $region, StoreRegion $request)
	{
		$region -> create($request->all());
		$request->session()->flash('alert-success', 'Регион успешно добавлен!');
		return redirect('regions');
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
		try{
			$region = Region::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('regions.edit',['regName'=>$region->reg_name, 'id'=>$region->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreRegion $request, $id)
	{
		try{
			$region = Region::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$region->update($request->all());
		$region->save();
		return redirect('regions')->with('alert-success','Регион обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$region = Region::find($id);
		$region->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Регион '. $region->reg_name .' удален');
	}

}

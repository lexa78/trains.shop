<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Http\Requests\StoreYear;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class YearController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$years = Year::orderBy('year','desc')->get();

		return view('years.index',['years'=>$years]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('years.create',['year'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Year $year, StoreYear $request)
	{
		$year -> create($request->all());
		return redirect('years')->with('alert-success', 'Год выпуска успешно добавлен!');
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
			$year = Year::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('years.edit',['year'=>$year->year, 'id'=>$year->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreYear $request, $id)
	{
		try{
			$year = Year::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$year->update($request->all());
		$year->save();
		return redirect('years')->with('alert-success','Год выпуска обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$year = Year::find($id);
		$year->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Год выпуска '. $year->year .' удален');
	}

}

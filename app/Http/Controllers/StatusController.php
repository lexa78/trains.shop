<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreStatus;
use App\Models\Status;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class StatusController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = Status::all();
		return view('statuses.index',['statuses'=>$statuses]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('statuses.create',['status'=>null, 'is_first'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Status $status, StoreStatus $request)
	{
		$status -> create($request->all());
		return redirect('statuses')->with('alert-success', 'Статус успешно добавлен!');
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
			$status = Status::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('statuses.edit',['status'=>$status->status, 'is_first'=>$status->is_first, 'id'=>$status->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreStatus $request, $id)
	{
		try{
			$status = Status::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$status->update($request->all());
		$status->save();
		return redirect('statuses')->with('alert-success','Статус обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$status = Status::find($id);
		$status->delete();
		return back()->with('alert-success','Статус '. $status->status .' удален');
	}

}

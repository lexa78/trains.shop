<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\StoreServiceStatus;
use App\Models\ServiceStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ServiceStatusController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = ServiceStatus::all();
		return view('serviceStatuses.index',['statuses'=>$statuses]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('serviceStatuses.create',['status'=>null, 'is_first'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(ServiceStatus $status, StoreServiceStatus $request)
	{
		$status -> create($request->all());
		return redirect('service_statuses')->with('alert-success', 'Статус успешно добавлен!');
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
			$status = ServiceStatus::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('serviceStatuses.edit',['status'=>$status->status, 'is_first'=>$status->is_first, 'id'=>$status->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreServiceStatus $request, $id)
	{
		try{
			$status = ServiceStatus::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$status->update($request->all());
		$status->save();
		return redirect('service_statuses')->with('alert-success','Статус обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $status = ServiceStatus::find($id);
        $status->delete();
        return back()->with('alert-success','Статус '. $status->status .' удален');
	}

}

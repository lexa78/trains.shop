<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Condition;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCondition;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ConditionController extends Controller {

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
		$conds = Condition::all();

		return view('conditions.index',['conds'=>$conds]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('conditions.create',['cond'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Condition $condition, StoreCondition $request)
	{
		$condition -> create($request->all());
		return redirect('conditions')->with('alert-success', 'Состояние успешно добавлено!');
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
			$cond = Condition::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('conditions.edit',['cond'=>$cond->condition, 'id'=>$cond->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreCondition $request, $id)
	{
		try{
			$cond = Condition::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$cond->update($request->all());
		$cond->save();
		return redirect('conditions')->with('alert-success','Состояние обновлено');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$cond = Condition::find($id);
		$cond->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Состояние '. $cond->condition .' удалено');
	}

}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Factory;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FactoryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$factories = Factory::all();

		return view('factories.index',['factories'=>$factories]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('factories.create',['factory'=>null, 'factoryCode'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Factory $factory, StoreFactory $request)
	{
		$factory -> create($request->all());
		return redirect('factories')->with('alert-success', 'Завод-производитель успешно добавлен!');
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
			$factory = Factory::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('factories.edit',['factory'=>$factory->factory_name, 'factoryCode'=>$factory->factory_code, 'id'=>$factory->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreFactory $request, $id)
	{
		try{
			$factory = Factory::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$factory->update($request->all());
		$factory->save();
		return redirect('factories')->with('alert-success','Завод-производитель обновлен');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$factory = Factory::find($id);
		$factory->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Завод с названием '. $factory->factory_name .' удален');
	}

}

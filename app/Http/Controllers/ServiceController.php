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
		return view('services.create',['service'=>null]);
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
			'price' => 'required|numeric'
		];

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

        $service->short_name = $request->short_name;
        $service->full_name = $request->full_name;
        $service->unit = $request->unit;
        $service->period = $request->period;
        $service->documents = $request->documents;
        $service->price = $request->price;
        if($request->need_station) {
            $service->need_station = 1;
        }
        $service->save();

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

		return view('services.show',['service'=>$service]);

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

		return view('services.edit',['service'=>$service, 'id'=>$service->id]);
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
			'price' => 'required|numeric',
		];

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

        $service->short_name = $request->short_name;
        $service->full_name = $request->full_name;
        $service->unit = $request->unit;
        $service->period = $request->period;
        $service->documents = $request->documents;
        $service->price = $request->price;
        $service->need_station = ($request->need_station ? 1 : 0);
        $service->save();

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

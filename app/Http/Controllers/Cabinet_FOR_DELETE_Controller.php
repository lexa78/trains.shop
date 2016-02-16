<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Firm;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class CabinetController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = Auth::user();
		$firmName = $user->firm->organisation_name;
		$countOfOrders = Order::where('user_id', Auth::user()->id)->count();
		$countOfDocuments = Document::where('user_id', Auth::user()->id)->count();
		return view('cabinet.index', [
										'p'=>'cabinet',
										'userId' => $user->id,
										'firmName' => $firmName,
										'countOfOrders'=>$countOfOrders,
										'countOfDocuments'=>$countOfDocuments
									]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}

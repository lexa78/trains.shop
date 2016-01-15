<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Factory;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use App\Models\Stantion;
use App\Models\Status;
use App\Models\TrainRoad;
use Illuminate\Http\Request;
use App\Models\Year;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index(Region $region, TrainRoad $trainRoad, Stantion $stantion)
	{
		$regionsCount = $region->all()->count();
		$tRoadsCount = $trainRoad->all()->count();
		$stationsCount = $stantion->all()->count();

		$yearsCount = Year::all()->count();
		$condCount = Condition::all()->count();
		$factoriesCount = Factory::all()->count();
		$productsCount = Product::all()->count();
		$servicesCount = Service::all()->count();

		$catCount = Category::all()->count();

		$statusesCount = Status::all()->count();

		return view('admin.adminArea',['regionsCount'=>$regionsCount, 'tRoadsCount'=>$tRoadsCount, 'stationsCount'=>$stationsCount,
					'yearsCount'=>$yearsCount, 'condCount'=>$condCount, 'factoriesCount'=>$factoriesCount, 'catCount'=>$catCount,
					'productsCount'=>$productsCount, 'servicesCount'=>$servicesCount, 'statusesCount'=>$statusesCount]);
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

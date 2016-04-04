<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Factory;
use App\Models\Order;
use App\Models\Product;
use App\Models\Region;
use App\Models\Service;
use App\Models\ServiceOrder;
use App\Models\ServiceStatus;
use App\Models\Stantion;
use App\Models\Status;
use App\Models\TrainRoad;
use Illuminate\Http\Request;
use App\Models\Year;

class AdminController extends Controller {

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
	public function index(Region $region, TrainRoad $trainRoad, Stantion $stantion)
	{
		$regionsCount = $region->count();
		$tRoadsCount = $trainRoad->count();
		$stationsCount = $stantion->count();

		$condCount = Condition::count();
		$productsCount = Product::count();
		$servicesCount = Service::count();

		$catCount = Category::count();

		$statusesCount = Status::count();

		$serviceStatusesCount = ServiceStatus::count();

		$newOrdersCount = Order::where('is_new',1)->count();
		$newServiceOrdersCount = ServiceOrder::where('is_new',1)->count();

		return view('admin.adminArea',['regionsCount'=>$regionsCount, 'tRoadsCount'=>$tRoadsCount, 'stationsCount'=>$stationsCount,
					'condCount'=>$condCount, 'catCount'=>$catCount, 'productsCount'=>$productsCount, 'servicesCount'=>$servicesCount,
				    'statusesCount'=>$statusesCount, 'newOrdersCount'=>$newOrdersCount, 'serviceStatusesCount'=>$serviceStatusesCount,
		            'newServiceOrdersCount'=>$newServiceOrdersCount]);
	}

	public function pageTexts()
	{
		return view('admin.pageTexts');
	}
//
//	/**
//	 * Store a newly created resource in storage.
//	 *
//	 * @return Response
//	 */
//	public function store()
//	{
//		//
//	}
//
//	/**
//	 * Display the specified resource.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function show($id)
//	{
//		//
//	}
//
//	/**
//	 * Show the form for editing the specified resource.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function edit($id)
//	{
//		//
//	}
//
//	/**
//	 * Update the specified resource in storage.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function update($id)
//	{
//		//
//	}
//
//	/**
//	 * Remove the specified resource from storage.
//	 *
//	 * @param  int  $id
//	 * @return Response
//	 */
//	public function destroy($id)
//	{
//		//
//	}

}

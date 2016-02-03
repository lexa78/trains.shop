<?php namespace App\Http\Controllers;

use App\Commands\CreatePaymentDocs;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Order;
use Bus;
use Illuminate\Http\Request;

class CreateDocumentsController extends Controller {

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($orderID)
	{
		$order = Order::find($orderID);
        Bus::dispatch(new CreatePaymentDocs($order));
        //return view('documents.torg_12');
	}
}

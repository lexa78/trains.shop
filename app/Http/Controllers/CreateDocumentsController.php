<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreatePaymentDocs;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Order;
use App\Models\User;
use Bus;
use DateTime;
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
        //Bus::dispatch(new CreatePaymentDocs($order));
		$selfFirmUser = User::with('firm')->where('role_id',User::ADMIN)->first();

		$clientCompany = User::with('firm')->where('id',$order->user_id)->first();

		$products = $order->products_in_order;
		$firm = $clientCompany->firm;

		$productsArr = [];
		foreach($products as $product) {
			$productsArr[] = [
				'product_name' => $product->product_name,
				'product_amount' => $product->product_amount,
				'product_price' => $product->product_price
			];
		}

		$date = DateTime::createFromFormat('Y-m-d H:i:s', $order->created_at);
		$date = strtotime($date->format('d F Y'));

		$pdf = App::make('dompdf.wrapper');

		$pdf->loadView('documents.torg_12',[
			'orderNumber'=>$order->id,
			'orderDate'=>date('d.m.Y',$date),
			'firm'=>$firm,
			'selfFirm'=>$selfFirmUser->firm,
			'products'=>$productsArr,
			//  'depoId'=>$this->depo->id
		]);

        $pdf->setOrientation('landscape');

		//$pdf->download('invoice.pdf');
		return $pdf->stream();
//		$pdf->save('qwert111.pdf');

		//return view('documents.torg_12');
	}
}

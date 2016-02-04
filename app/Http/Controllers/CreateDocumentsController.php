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
	public function create($orderID, $isTorg)
	{
		$order = Order::find($orderID);
        //Bus::dispatch(new CreatePaymentDocs($order, $isTorg));
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

        $viewType = null;

        if($isTorg) {
            $viewType = 'documents.torg_12';
        } else {
            $viewType = 'documents.schet_factura';
        }
//return view('documents.schet_factura', [
//            'orderNumber'=>$order->id,
//            'orderDate'=>date('d.m.Y',$date),
//            'firm'=>$firm,
//            'selfFirm'=>$selfFirmUser->firm,
//            'products'=>$productsArr,
//        ]);
        $pdf->loadView($viewType,[
            'orderNumber'=>$order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
        ]);

        $pdf->setOrientation('landscape');
        //$pdf->setPaper('A4', 'landscape');

        return $pdf->stream();

    }
}

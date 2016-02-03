<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\User;
use Auth;
use DateTime;
use Illuminate\Contracts\Bus\SelfHandling;

class CreatePaymentDocs extends Command implements SelfHandling {

	protected $order;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($order)
	{
        $this->order = $order;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $selfFirmUser = User::with('firm')->where('id',Auth::user()->id)->first();

        $clientCompany = User::with('firm')->where('id',$this->order->user_id)->first();

        $products = $this->order->products_in_order;
        $firm = $clientCompany->firm;

        $productsArr = [];
        foreach($products as $product) {
            $productsArr[] = [
                'product_name' => $product->product_name,
                'product_amount' => $product->product_amount,
                'product_price' => $product->product_price
            ];
        }

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $this->order->updated_at);
        $date = strtotime($date->format('d F Y'));

        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('documents.torg_12',[
            'orderNumber'=>$this->order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
          //  'depoId'=>$this->depo->id
        ]);

        //$pdf->download('invoice.pdf');
        $pdf->stream();
    }

}

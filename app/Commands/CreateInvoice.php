<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\Order;
use App\Models\Stantion;
use App\Models\User;
use Config;
use DateTime;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class CreateInvoice extends Command implements SelfHandling {

    //use SerializesModels;

	protected $order;
	protected $depo;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Order $order, Stantion $stantion)
	{
		$this->order = $order;
        $this->depo = $stantion;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $selfFirmUser = User::with('firm')->where('role_id',User::ADMIN)->first();

        $userCompany = User::with('firm')->where('id',$this->order->user_id)->first();

        $products = $this->order->products_in_order;
        $firm = $userCompany->firm;

        $productsArr = [];
        foreach($products as $product) {
            $productsArr[$this->depo->id][] = [
                'product_name' => $product->product_name,
                'product_amount' => $product->product_amount,
                'product_price' => $product->product_price
            ];
        }

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $this->order->updated_at);
        $date = strtotime($date->format('d F Y'));

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('documents.invoice',[
            'orderNumber'=>$this->order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
            'depoId'=>$this->depo->id
        ]);
        $pdf->save(storage_path().'/app/documents/invoice.pdf');
        $exists = Storage::disk('local')->exists('documents');
        dd(Config::get('documents'));
    }

    public function invoice($orderNumber, $depoName, $look)
    {

        //$pdf->save('invoices/invoice.pdf');
        if($look) {
            return $pdf->stream();
        } else {
            return $pdf->download('invoice.pdf');
        }

//		$selfFirmUser = User::with('firm')->where('role_id',1)->first();
//
//  //      $file = 'invoice.pdf';
//
//		$pdf = App::make('dompdf.wrapper');
////		$pdf->loadHTML('');
//		$pdf->loadView('test',['orderNumber'=>5864, 'firm'=>$firm, 'selfFirm'=>$selfFirmUser->firm]);
////		$view =  View::make('test',['orderNumber'=>5864])->render();
////		$pdf->loadHTML($view);
//	//	return $pdf->download('invoice.pdf');
//   //     file_put_contents($file, $view);
////        $pdf->loadFile('C:\OpenServer\domains\trains.shop\public\invoices\invoice.html');
//		return $pdf->stream();
////		return $pdf->save();
//	//	dd($view);
    }

}

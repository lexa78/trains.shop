<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\Order;
use App\Models\Stantion;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Auth;
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

        //$whereAreClientDocuments = storage_path().'/app'.Config::get('documents')['documents_folder'];
        $documents = Config::get('documents');
        $whereAreClientDocuments = $documents['documents_folder'];
        //client_{id}
        if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.Auth::user()->id)) {
            Storage::makeDirectory($whereAreClientDocuments.'/client_'.Auth::user()->id);
        }
        //invoices
        if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.Auth::user()->id.'/invoices')) {
            Storage::makeDirectory($whereAreClientDocuments.'/client_'.Auth::user()->id.'/invoices');
        }

        $clientFolder = storage_path().'/app'.$whereAreClientDocuments.'/client_'.Auth::user()->id.'/invoices';

        //invoice_{orderID}_{depoName}_date_{currentDate}
        $fileNameTemplate = $documents['client_invoice_template'];

        $fileNameTemplate = Utils::mb_str_replace('{orderID}', $this->order->id, $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{depoName}', $this->depo->stantion_name, $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

        $pdf->save($clientFolder.'/'.$fileNameTemplate);
    }

}

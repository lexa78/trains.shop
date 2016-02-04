<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\Document;
use App\Models\Order;
use App\Models\Stantion;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Auth;
use Bus;
use Config;
use DateTime;
use Illuminate\Contracts\Bus\SelfHandling;
use Storage;

class CreatePaymentDocs extends Command implements SelfHandling {

	protected $order;
	protected $isTorg;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($order, $isTorg)
	{
        $this->order = $order;
        $this->isTorg = $isTorg;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
        $selfFirmUser = User::with('firm')->where('role_id',User::ADMIN)->first();

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

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $this->order->created_at);
        $date = strtotime($date->format('d F Y'));

        $pdf = App::make('dompdf.wrapper');

        $viewType = null;

        if($this->isTorg) {
            $viewType = 'documents.torg_12';
        } else {
            $viewType = 'documents.schet_factura';
        }

        $pdf->loadView($viewType,[
            'orderNumber'=>$this->order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
        ]);

        //$pdf->setOrientation('landscape');
        $pdf->setPaper('A4', 'landscape');

        $documents = Config::get('documents');
        $whereAreClientDocuments = $documents['documents_folder'];
        //client_{id}
        if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.$this->order->user_id)) {
            Storage::makeDirectory($whereAreClientDocuments.'/client_'.$this->order->user_id);
        }
        //paymentDocs
        if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.$this->order->user_id.'/paymentDocs')) {
            Storage::makeDirectory($whereAreClientDocuments.'/client_'.$this->order->user_id.'/paymentDocs');
        }

        $clientFolder = storage_path().'/app'.$whereAreClientDocuments.'/client_'.$this->order->user_id.'/paymentDocs';
        //(torg12/schetfactura)_{orderID}_{depoName}_date_{currentDate}
        $fileNameTemplate = $documents['client_invoice_template'];

        $fileNameTemplate = Utils::mb_str_replace('{docType}', Order::getDocTypeName($this->isTorg ? Order::AUCTION_12_TYPE : Order::INVOICE_ACCT_TYPE), $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{orderID}', $this->order->id, $fileNameTemplate);
        $depo = Stantion::find($this->order->products_in_order[0]->stantion_id);
        $depoName = Utils::mb_str_replace(' ','',$depo->stantion_name);
        $depoName = Utils::translit($depoName);
        $fileNameTemplate = Utils::mb_str_replace('{depoName}', $depoName, $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

        $pdf->save($clientFolder.'/'.$fileNameTemplate);

        $docs = new Document();
        $docs->type = Order::AUCTION_12_TYPE;
        $docs->user_id = $this->order->user_id;
        $docs->order_id = $this->order->id;
        $docs->file_name = $clientFolder.'/'.$fileNameTemplate;
        $docs->save();

        Bus::dispatch(new SendEmailWithPaymentDocs($docs->file_name, $this->isTorg, $this->order));
    }

}

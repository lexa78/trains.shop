<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\Document;
use App\Models\Firm;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stantion;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use App\MyDesigns\Petrovich\Petrovich;
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
                'product_price' => $product->product_price,
                'product_nds' => Product::getVAT_calculationByKey($product->nds),
                'product_nds_as_str' => Product::getAllVAT_rateByKey($product->nds),
            ];
        }

        $date = DateTime::createFromFormat('Y-m-d H:i:s', $this->order->created_at);
        $date = strtotime($date->format('d F Y'));

        if( ! $firm->rp_face_fio) {
            $faceFioArr = explode(' ',$firm->face_fio);
            $lastName = isset($faceFioArr[0]) ? $faceFioArr[0] : '';
            $name = isset($faceFioArr[1]) ? $faceFioArr[1] : '';
            $secondName = isset($faceFioArr[2]) ? $faceFioArr[2] : '';

            $petrovich = new Petrovich();

            $petrovich->gender = $petrovich->detectGender($secondName);

            if($petrovich->gender == Petrovich::FAIL_MIDDLEWARE) {
                $fio = $firm->face_fio;
            } else {
                $fio = $petrovich->lastname($lastName, Petrovich::CASE_GENITIVE).' '.$petrovich->firstname($name, Petrovich::CASE_GENITIVE).' '.$petrovich->middlename($secondName, Petrovich::CASE_GENITIVE);
                $firm->rp_face_fio = $fio;
                $firm->save();
            }
        } else {
            $fio = $firm->rp_face_fio;
        }

        if( ! $firm->rp_face_position) {
            $facePosition = Utils::getGenitiveCase($firm->face_position);
            if($facePosition != $firm->face_position) {
                $firm->rp_face_position = $facePosition;
                $firm->save();
            }
        } else {
            $facePosition = $firm->rp_face_position;
        }

        if( ! $firm->rp_base_document) {
            $baseDocument = Utils::getGenitiveCase($firm->base_document);
            if($baseDocument != $firm->base_document) {
                $firm->rp_base_document = $baseDocument;
                $firm->save();
            }
        } else {
            $baseDocument = $firm->rp_base_document;
        }
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('documents.invoice',[
            'orderNumber'=>$this->order->id,
            'orderDate'=>date('d.m.Y',$date),
            'firm'=>$firm,
            'firmRpFio'=>$fio,
            'firmFacePosition'=>$facePosition,
            'firmBaseDocument'=>$baseDocument,
            'selfFirm'=>$selfFirmUser->firm,
            'products'=>$productsArr,
            'depoId'=>$this->depo->id,
            'depoName'=>$this->depo->stantion_name
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

        $fileNameTemplate = Utils::mb_str_replace('{docType}', Order::getDocTypeName(Order::INVOICE_TYPE), $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{orderID}', $this->order->id, $fileNameTemplate);
        $depoName = Utils::mb_str_replace(' ','',$this->depo->stantion_name);
        $depoName = Utils::translit($depoName);
        $fileNameTemplate = Utils::mb_str_replace('{depoName}', $depoName, $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

        $pdf->save($clientFolder.'/'.$fileNameTemplate);

        $docs = new Document();
        $docs->type = Order::INVOICE_TYPE;
        $docs->user_id = Auth::user()->id;
        $docs->order_id = $this->order->id;
        $docs->file_name = $clientFolder.'/'.$fileNameTemplate;
        $docs->sended = 1;
        $docs->save();
    }

}

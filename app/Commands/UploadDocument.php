<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Order;
use App\Models\Stantion;
use App\MyDesigns\Classes\Utils;
use Config;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use League\Flysystem\Exception;
use Log;
use Storage;

class UploadDocument extends Command implements SelfHandling {

	protected $file;
	protected $order;
	protected $docType;
	protected $documentFor;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($file, $order, $docType, $documentFor)
	{
		$this->file = $file;
        $this->order = $order;
        $this->docType = $docType;
        $this->documentFor = $documentFor;
	}

	/**
	 * Execute the command.
	 *
//	 * @return void
	 */
	public function handle()
	{
		$documents = Config::get('documents');
		$whereAreClientDocuments = $documents['documents_folder'];
		//client_{id}
		if( ! Storage::disk('local')->exists($whereAreClientDocuments.DIRECTORY_SEPARATOR.'client_'.$this->order->user_id)) {
			Storage::makeDirectory($whereAreClientDocuments.DIRECTORY_SEPARATOR.'client_'.$this->order->user_id);
		}
		//paymentDocs
		if( ! Storage::disk('local')->exists($whereAreClientDocuments.DIRECTORY_SEPARATOR.'client_'.$this->order->user_id.DIRECTORY_SEPARATOR.Order::getDocTypeName($this->docType))) {
			Storage::makeDirectory($whereAreClientDocuments.DIRECTORY_SEPARATOR.'client_'.$this->order->user_id.DIRECTORY_SEPARATOR.Order::getDocTypeName($this->docType));
		}

		$clientFolder = $whereAreClientDocuments.DIRECTORY_SEPARATOR.'client_'.$this->order->user_id.DIRECTORY_SEPARATOR.Order::getDocTypeName($this->docType);
		//(torg12/schetfactura)_{orderID}_{depoName}_date_{currentDate}
		$fileNameTemplate = ($this->documentFor == Order::DOCUMENT_FOR_SERVICE) ? $documents['client_service_document_template'] : $documents['client_document_template'];

		$fileNameTemplate = Utils::mb_str_replace('{docType}', Order::getDocTypeName($this->docType), $fileNameTemplate);
		$fileNameTemplate = Utils::mb_str_replace('{orderID}', $this->order->id, $fileNameTemplate);
		if($this->documentFor == Order::DOCUMENT_FOR_SPARE_PART) {
			$depoName = Stantion::find($this->order->products_in_order[0]->stantion_name);
			$depoName = Utils::mb_str_replace(' ','',$depoName);
			$depoName = Utils::translit($depoName);
			$fileNameTemplate = Utils::mb_str_replace('{depoName}', $depoName, $fileNameTemplate);
		}
		$fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

		$extension = $this->file->getClientOriginalExtension();
        try {
            Storage::disk('local')->put($clientFolder.DIRECTORY_SEPARATOR.$fileNameTemplate.'.'.$extension,  File::get($this->file));
        } catch(Exception $e) {
            Log::error('Ошибка загрузки файла '.$fileNameTemplate.' message - '.$e->getMessage());
            return false;
        }
        return storage_path().DIRECTORY_SEPARATOR.'app'.$clientFolder.DIRECTORY_SEPARATOR.$fileNameTemplate;
	}

}

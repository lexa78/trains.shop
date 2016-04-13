<?php namespace App\Commands;

use App\Commands\Command;

use App\Models\Document;
use App\Models\Order;
use Config;
use Exception;
use File;
use Illuminate\Contracts\Bus\SelfHandling;
use Log;
use Storage;

class UploadServiceAgreement extends Command implements SelfHandling {

	protected $file;
	protected $firm;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct($file, $firm)
	{
		$this->file = $file;
		$this->firm = $firm;
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
		if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.$this->firm->user->id)) {
			Storage::makeDirectory($whereAreClientDocuments.'/client_'.$this->firm->user->id);
		}
		//agreement
		if( ! Storage::disk('local')->exists($whereAreClientDocuments.'/client_'.$this->firm->user->id.'/service_agreement')) {
			Storage::makeDirectory($whereAreClientDocuments.'/client_'.$this->firm->user->id.'/service_agreement');
		}

        $clientFilePath = $whereAreClientDocuments.'/client_'.$this->firm->user->id.'/service_agreement';

		$extension = $this->file->getClientOriginalExtension();

		//get all files from folder end delete them
		$files = Storage::files($clientFilePath);
        if( ! empty($files)) {
            $agreementDocIds = Document::select('id')->where('type',Order::CONTRACT_TYPE)->where('user_id',$this->firm->user->id)->get();
            $agreementDocIdsArr = [];
            foreach($agreementDocIds as $agreementDocId) {
                $agreementDocIdsArr[] = $agreementDocId->id;
            }
            Document::destroy($agreementDocIdsArr);
        }
		Storage::delete($files);

        $file = array_shift($files);
        $filePathBySlash = explode(DIRECTORY_SEPARATOR,$file);
        $fileName = end($filePathBySlash);
        $fileNameBy_ = explode('_',$fileName);
        $fileDateWithExtension = time().'.'.$extension;
        array_pop($fileNameBy_);
        $fileNameBy_[] = $fileDateWithExtension;
        $fileName = implode('_',$fileNameBy_);
        array_pop($filePathBySlash);
        $filePathBySlash[] = $fileName;
        $file = implode(DIRECTORY_SEPARATOR,$filePathBySlash);
		try {
			Storage::disk('local')->put($file,  File::get($this->file));
		} catch(Exception $e) {
			Log::error('Ошибка загрузки файла с договором оферты'.' message - '.$e->getMessage());
			return false;
		}
        $docs = new Document();
        $docs->type = Order::CONTRACT_TYPE;
        $docs->user_id = $this->firm->user->id;
        $docs->file_name = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$file;
        $docs->sended = 1;
        $docs->save();
        return storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$file;
	}
}

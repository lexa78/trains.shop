<?php namespace App\Commands;

use App;
use App\Commands\Command;

use App\Models\Document;
use App\Models\Firm;
use App\Models\Order;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Bus;
use Config;
use Illuminate\Contracts\Bus\SelfHandling;
use Storage;

class CreateServiceAgreement extends Command implements SelfHandling {

	protected $firm;
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(Firm $firm)
	{
		$this->firm = $firm;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		$pdf = App::make('dompdf.wrapper');
		$pdf->loadView('documents.serviceAgreementTemplate',[
			'firm'=>$this->firm->organisation_name,
			'rs'=>$this->firm->rs,
		]);

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

        //очищаем папку от всех файлов
        $files = Storage::files($whereAreClientDocuments.'/client_'.$this->firm->user->id.'/service_agreement');
        if( ! empty($files)) {
            $agreementDocIds = Document::select('id')->where('type',Order::CONTRACT_TYPE)->where('user_id',$this->firm->user->id)->get();
            $agreementDocIdsArr = [];
            foreach($agreementDocIds as $agreementDocId) {
                $agreementDocIdsArr[] = $agreementDocId->id;
            }
            Document::destroy($agreementDocIdsArr);
        }
        Storage::delete($files);
        //создаем новый файл
		$clientFolder = storage_path().'/app'.$whereAreClientDocuments.'/client_'.$this->firm->user->id.'/service_agreement';
		//{docType}_contragent_{clientId}_date_{currentDate}.pdf
		$fileNameTemplate = $documents['client_service_agreement_template'];

		$fileNameTemplate = Utils::mb_str_replace('{docType}', Order::getDocTypeName(Order::CONTRACT_TYPE), $fileNameTemplate);
		$fileNameTemplate = Utils::mb_str_replace('{clientId}', $this->firm->user->id, $fileNameTemplate);
		$fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

		$pdf->save($clientFolder.'/'.$fileNameTemplate);

		$docs = new Document();
		$docs->type = Order::CONTRACT_TYPE;
		$docs->user_id = $this->firm->user->id;
		$docs->file_name = $clientFolder.'/'.$fileNameTemplate;
		$docs->sended = 1;
		$docs->save();

        $user = User::find($this->firm->user->id);
        $emailContent['userName'] =  $user->name;
        $emailContent['email'] =  $user->email;
		Bus::dispatch(new SendEmailWithServiceAgreement($emailContent, $clientFolder.'/'.$fileNameTemplate));
	}
}
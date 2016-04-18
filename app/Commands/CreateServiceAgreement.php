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
use iio\libmergepdf\Merger;
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
        $documents = Config::get('documents');
        $whereAreClientDocuments = $documents['documents_folder'];
        //client_{id}
        if (!Storage::disk('local')->exists($whereAreClientDocuments . '/client_' . $this->firm->user->id)) {
            Storage::makeDirectory($whereAreClientDocuments . '/client_' . $this->firm->user->id);
        }
        //agreement
        if (!Storage::disk('local')->exists($whereAreClientDocuments . '/client_' . $this->firm->user->id . '/service_agreement')) {
            Storage::makeDirectory($whereAreClientDocuments . '/client_' . $this->firm->user->id . '/service_agreement');
        }

        //очищаем папку от всех файлов
        $files = Storage::files($whereAreClientDocuments . '/client_' . $this->firm->user->id . '/service_agreement');
        if (!empty($files)) {
            $agreementDocIds = Document::select('id')->where('type', Order::CONTRACT_TYPE)->where('user_id', $this->firm->user->id)->get();
            $agreementDocIdsArr = [];
            foreach ($agreementDocIds as $agreementDocId) {
                $agreementDocIdsArr[] = $agreementDocId->id;
            }
            Document::destroy($agreementDocIdsArr);
        }
        Storage::delete($files);
        //создаем новый файл
        $clientFolder = storage_path() . '/app' . $whereAreClientDocuments . '/client_' . $this->firm->user->id . '/service_agreement';
        //{docType}_contragent_{clientId}_date_{currentDate}.pdf
        $fileNameTemplate = $documents['client_service_agreement_template'];

        $fileNameTemplate = Utils::mb_str_replace('{docType}', Order::getDocTypeName(Order::CONTRACT_TYPE), $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{clientId}', $this->firm->user->id, $fileNameTemplate);
        $fileNameTemplate = Utils::mb_str_replace('{currentDate}', time(), $fileNameTemplate);

//		$pdf->save($clientFolder.'/'.$fileNameTemplate);

//********************************************************
        /*
* Номер текущей страницы
* если требуется сгенерировать несколько документов
*/
      //  $current_page = 1;
//****************************************************
//+++++++++++++++++++++++++++++++++++++++++++++++++++++
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('documents.serviceAgreementTemplate', [
            'fullFirmName' => $this->firm->full_organisation_name,
            'shortFirmName' => $this->firm->organisation_name,
            'position' => $this->firm->rp_face_position,
            'fio' => $this->firm->rp_face_fio,
            'baseDocument' => $this->firm->rp_base_document,
            'inn' => $this->firm->inn,
            'kpp' => $this->firm->kpp,
            'address' => $this->firm->place_address,
            'rs' => $this->firm->rs,
            'bank' => $this->firm->bank,
            'ks' => $this->firm->ks,
            'bik' => $this->firm->bik,
            'phone' => $this->firm->phone,
            'email' => $this->firm->user->email,
        ]);
//+++++++++++++++++++++++++++++++++++++++++++++++
//        $dom_pdf = $pdf->getDomPDF();
//        $canvas = $dom_pdf->get_canvas();
//        dd($canvas);
//        $canvas->page_text(0, 0, "Page {PAGE_NUM} of {PAGE_COUNT}", null, 10, array(0, 0, 0));
//--------------------------------------------
        $m = new Merger();
        $m->addRaw($pdf->output());
//****************************************************
//        $signs = array (
//            'start-page' => $current_page);
//
//        // Замена меток в шаблоне их значениями
//        foreach ($signs as $key => $value) {
//            $template = str_replace('{' . $key . '}', $value, $template);
//        }
        /*
        * Увеличили счетчик числа сгенерированных страниц
        * на число страниц текущего документа
        */
//        $current_page = $current_page + $dom_pdf->get_canvas()->get_page_count();
//********************************************************
        unset($pdf);

        $pdf = App::make('dompdf.wrapper');
		$pdf->setPaper('a4', 'landscape')->loadView('documents.serviceAgreementTemplate2');
        $m->addRaw($pdf->output());

        file_put_contents($clientFolder.'/'.$fileNameTemplate, $m->merge());

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
<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreatePaymentDocs;
use App\Commands\CreateServiceAgreement;
use App\Commands\UploadDocument;
use App\Commands\UploadServiceAgreement;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Firm;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use App\MyDesigns\Petrovich\Petrovich;
use Auth;
use Bus;
use Config;
use DateTime;
use Illuminate\Http\Request;
use Response;
use Storage;
use Validator;

class CreateDocumentsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['create', 'uploadDocument', 'uploadOfertaIndex',
                    'uploadOferta', 'showOferta', 'editServiceAgreementTemplate',
                    'updateServiceAgreementTemplate', 'createServiceAgreementTemplateAndSend',
                    'showServiceAgreementByClients', 'createServiceAgreement',
                    'uploadServiceAgreementFromClient', 'showServiceAgreementWithClient']]);
        $this->middleware('admin', ['only'=>['create', 'uploadDocument', 'uploadOfertaIndex',
                    'uploadOferta', 'editServiceAgreementTemplate',
                    'updateServiceAgreementTemplate', 'createServiceAgreementTemplateAndSend',
                    'showServiceAgreementByClients', 'createServiceAgreement',
                    'uploadServiceAgreementFromClient', 'showServiceAgreementWithClient']]);
        $this->middleware('general', ['only'=>['showOferta']]);
    }

    /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($orderID, $isTorg)
	{
		if(Auth::user()->role_id == User::ADMIN) {
            $order = Order::find($orderID);
            Bus::dispatch(new CreatePaymentDocs($order, $isTorg));
            return redirect()->back()->with('alert-success', 'Документ создан и отправлен клиенту по email');
        } else {
            return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
        }
    }

    public function download(Request $request)
    {
        $file = Document::where('file_name','like','%'.$request->input('shortFileName'))->where('user_id',Auth::user()->id)->first();
        if(! $file) {
            return redirect('fatal_error')->with('alert-danger', 'Произошла ошибка в работе сайта. Мы уже исправляем эту проблему. Попробуйте через некоторое время.');
        }
        if($request->input('download')) {
            return Response::download($file->file_name, $request->input('shownFileName'), ['Content-Length: '. filesize($file->file_name)]);
        } else {
            $contentType = 'application/pdf';
            if($request->input('content')) {
                $extension = strtolower($request->input('content'));
                if($extension != 'pdf') {
                    $contentType = 'image/'.$extension;
                }
            }
            return Response::make(file_get_contents($file->file_name), 200, [
                'Content-Type' => $contentType,
                'Content-Disposition' => 'inline; '.$request->input('shortFileName'),
            ]);
        }
    }

    public function showDocs()
    {
        $docs = Document::where('user_id', Auth::user()->id)->get();
        $docsByTypesArr = [];
        foreach($docs as $q => $doc) {
            $shortFileName = explode(DIRECTORY_SEPARATOR, $doc->file_name);
            $shortFileName = end($shortFileName);
            $tempFileName = explode('_', $shortFileName);
            $tempFileName = explode('.', end($tempFileName));
            $fileDate = date('d.m.Y', $tempFileName[0]);
            $typeOfDoc = Order::getDocTypeName($doc->type, true);
            if(( ! $doc->service_order_id) && ( ! $doc->order_id)) {
                $docId = null;
            } else {
                $docId = $doc->service_order_id ? $doc->service_order_id : $doc->order_id;
            }
            $extension = end($tempFileName);
            //$shownFileName = $typeOfDoc.' №'.$docId.'.'.$tempFileName[1];
            $temp  = $docId ? ' №'.$docId : ' по оказанию услуг';
            $shownFileName = $typeOfDoc.$temp.'.'.$extension;
            $docsByTypesArr[$typeOfDoc][] = [
                                                'shortFileName' => $shortFileName,
                                                'shownFileName' => $shownFileName,
                                                'extension' => $extension,
                                                'fileDate' => $fileDate,
                                                'orderNumber' => $doc->order_id ? $doc->order_id : $doc->service_order_id,
                                                'tempNumber'=>$temp
                                            ];
        }

        return view('documents.showDocs', ['p'=>'cabinet', 'documentsByTypes' => $docsByTypesArr]);
    }

    public function uploadDocument(Document $document, Requests\UploadDocument $request)
    {
        if($request->document_for == Order::DOCUMENT_FOR_SERVICE) {
            $order = ServiceOrder::find($request->order_id);
        } else {
            $order = Order::find($request->order_id);
        }
        $file = $request->file('docFileName'); //Сам файл
       if($pathToFile = Bus::dispatch(new UploadDocument($file, $order, $request->docType, $request->document_for))) {
           $document->type = $request->docType;
           $document->user_id = $order->user_id;
           if($request->document_for == Order::DOCUMENT_FOR_SERVICE) {
               $document->service_order_id = $request->order_id;
           } else {
               $document->order_id = $request->order_id;
           }
           $document->file_name = $pathToFile;
           $document->save();
           return redirect()->back()->with('alert-success','Файл загружен.');
       } else {
           return redirect()->back()->withInput()->with('alert-danger','Ошибка загрузки файла. Файл не загружен.');
       }
    }

    public function uploadOfertaIndex() {
        return view('documents.oferta');
    }

    public function uploadOferta(Document $document, Requests\UploadOferta $request) {
        $file = $request->file('docFileName'); //Сам файл
        if($pathToFile = Bus::dispatch(new App\Commands\UploadOferta($file))) {
            return redirect()->back()->with('alert-success','Файл загружен.');
        } else {
            return redirect()->back()->withInput()->with('alert-danger','Ошибка загрузки файла. Файл не загружен.');
        }
    }

    public function showOferta()
    {
        $files = Storage::files(DIRECTORY_SEPARATOR.'documents'.DIRECTORY_SEPARATOR.'oferta');
        $file = array_shift($files);
        $file = storage_path().DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.$file;

        $extension = explode('.',$file);
        $extension = strtolower(end($extension));

        $contentType = 'application/pdf';
        if($extension != 'pdf') {
            $contentType = 'image/'.$extension;
        }

        $shortFileName = explode('/',$file);
        $shortFileName = end($shortFileName);

        return Response::make(file_get_contents($file), 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; '.$shortFileName,
        ]);
    }

    public function editServiceAgreementTemplate()
    {
        $template = file_get_contents(Document::TEMPLATE_AGREEMENT_PATH);
        return view('documents.editServiceAgreementTemplate', ['template'=>$template]);
    }

    public function updateServiceAgreementTemplate(Request $request)
    {
        $validationRules = [
            'template' => 'required',
        ];

        $v = Validator::make($request->all(), $validationRules);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $template = file_put_contents(Document::TEMPLATE_AGREEMENT_PATH,$request->template);
        if($template !== false) {
            return redirect()->back()->with('alert-success','Шаблон договора по дополнительным услугам изменен');
        } else {
            return redirect('pageTexts')->with('alert-danger','При изменении шаблона, возникли ошибки. Шаблон НЕ ИЗМЕНЕН');
        }
    }

    public function checkGenitiveCase($firm_id, $order_id)
    {
        $firm = Firm::find($firm_id);
        if( ! $firm) {
            abort(404);
        }

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
        }

        return view('documents.showGenitiveCase', ['orderId'=>$order_id, 'fio'=>$fio,
            'firm_id'=>$firm_id, 'document'=>Utils::getGenitiveCase($firm->base_document),
            'position'=>Utils::getGenitiveCase($firm->face_position)]);
    }

    public function createServiceAgreementTemplateAndSend($firm_id, $order_id, Request $request)
    {
        $firm = Firm::where('id',$firm_id)->with('user')->first();
        if( ! $firm) {
            abort(404);
        }

        $firm->update($request->all());

        Bus::dispatch(new CreateServiceAgreement($firm));
        return redirect('showServiceSpecificOrderToAdmin/'.$order_id)->with('alert-success','Договор сформирован и отправлен клиенту');
    }

    public function showServiceAgreementByClients(Request $request)
    {
        $firms = Firm::where('accountant_fio',null)->get();
        if($request->firm_id) {
            $users = User::with('firm', 'document')->where('firm_id',$request->firm_id)->get();
        } else {
            $users = User::with('firm', 'document')->get();
        }
        return view('orders.showServiceAgreementByClientsToAdmin',
            ['users'=>$users, 'firms'=>$firms, 'firm_id'=>$request->firm_id]);
    }

    public function createServiceAgreement(Request $request)
    {
        $firm = Firm::where('id',$request->firmId)->first();
        if( ! $firm) {
            abort(404);
        }
        $firm->has_service_agreement = 1;
        $firm->save();
        return redirect()->back()->with('alert-success','Договор на оказание услуг с фирмой '.$firm->organisation_name.' заключен.');
    }

    public function uploadServiceAgreementFromClient(Document $document, Requests\UploadOferta $request) {
        $file = $request->file('docFileName'); //Сам файл
        $firm = Firm::with('user')->where('id',$request->firmId)->first();
        if($pathToFile = Bus::dispatch(new UploadServiceAgreement($file, $firm))) {
            return redirect()->back()->with('alert-success','Файл загружен.');
        } else {
            return redirect()->back()->withInput()->with('alert-danger','Ошибка загрузки файла. Файл не загружен.');
        }
    }

    public function showServiceAgreementWithClient($id)
    {
        $serviceAgreement = Document::find($id);

        $file = $serviceAgreement->file_name;
        $extension = explode('.',$file);
        $extension = strtolower(end($extension));

        $contentType = 'application/pdf';
        if($extension != 'pdf') {
            $contentType = 'image/'.$extension;
        }

        $shortFileName = explode('/',$file);
        $shortFileName = end($shortFileName);

        return Response::make(file_get_contents($file), 200, [
            'Content-Type' => $contentType,
            'Content-Disposition' => 'inline; '.$shortFileName,
        ]);
    }

    public function editInvoiceTemplate()
    {
        $template = file_get_contents(Document::TEMPLATE_INVOICE_PATH);
        return view('documents.editInvoiceTemplate', ['template'=>$template]);
    }

    public function updateInvoiceTemplate (Request $request)
    {
        $validationRules = [
            'template' => 'required',
        ];

        $v = Validator::make($request->all(), $validationRules);

        if ($v->fails())
        {
            return redirect()->back()->withErrors($v->errors())->withInput();
        }

        $template = file_put_contents(Document::TEMPLATE_INVOICE_PATH,$request->template);
        if($template !== false) {
            return redirect()->back()->with('alert-success','Шаблон счета изменен');
        } else {
            return redirect('pageTexts')->with('alert-danger','При изменении шаблона, возникли ошибки. Шаблон НЕ ИЗМЕНЕН');
        }
    }
}

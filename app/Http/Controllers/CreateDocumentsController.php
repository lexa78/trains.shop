<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreatePaymentDocs;
use App\Commands\UploadDocument;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\User;
use App\MyDesigns\Classes\Utils;
use Auth;
use Bus;
use Config;
use DateTime;
use Illuminate\Http\Request;
use Response;

class CreateDocumentsController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except'=>['create', 'uploadDocument']]);
        $this->middleware('admin', ['only'=>['create', 'uploadDocument']]);
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
        foreach($docs as $doc) {

            $shortFileName = explode(DIRECTORY_SEPARATOR, $doc->file_name);
            $shortFileName = end($shortFileName);
            $tempFileName = explode('_', $shortFileName);
            $tempFileName = explode('.', end($tempFileName));
            $fileDate = date('d.m.Y', $tempFileName[0]);
            $typeOfDoc = Order::getDocTypeName($doc->type, true);
            $docId = $doc->service_order ? $doc->service_order->id : $doc->order->id;
            $extension = end($tempFileName);
            //$shownFileName = $typeOfDoc.' №'.$docId.'.'.$tempFileName[1];
            $shownFileName = $typeOfDoc.' №'.$docId.'.'.$extension;
            $docsByTypesArr[$typeOfDoc][] = [
                                                'shortFileName' => $shortFileName,
                                                'shownFileName' => $shownFileName,
                                                'extension' => $extension,
                                                'fileDate' => $fileDate,
                                                'orderNumber' => $doc->order_id ? $doc->order_id : $doc->service_order_id
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
}

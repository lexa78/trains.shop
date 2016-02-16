<?php namespace App\Http\Controllers;

use App;
use App\Commands\CreatePaymentDocs;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Document;
use App\Models\Order;
use App\Models\User;
use Auth;
use Bus;
use Config;
use DateTime;
use Illuminate\Http\Request;
use Response;

class CreateDocumentsController extends Controller {

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
            return Response::make(file_get_contents($file->file_name), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; '.$request->input('shortFileName'),
            ]);
        }
    }

    public function showDocs()
    {
        $docs = Document::where('user_id', Auth::user()->id)->get();
        $docsByTypesArr = [];
        foreach($docs as $doc) {
            $fileName = explode(DIRECTORY_SEPARATOR,$doc->file_name);
            $fileName = end($fileName);
            $typeOfDoc = Order::getDocTypeName($doc->type, true);

            $date = DateTime::createFromFormat('Y-m-d H:i:s', $doc->created_at);
            $date = $date->format('d F Y');

            $docsByTypesArr[$typeOfDoc][] = [
                                                'shortFileName' => $fileName,
                                                'fileDate' => $date,
                                                'orderNumber' => $doc->order_id
                                            ];
        }

        return view('documents.showDocs', ['p'=>'cabinet', 'documentsByTypes' => $docsByTypesArr]);
    }
}

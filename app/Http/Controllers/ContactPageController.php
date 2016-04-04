<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ContactPage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

class ContactPageController extends Controller {

	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		try{
			$text = ContactPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		return view('pageTexts.edit',['text'=>$text, 'id'=>$id, 'page'=>'Контакты']);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request, $id)
	{
		try{
			$contactPage = ContactPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$validationRules = [
			'text' => 'required',
		];

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

		$contactPage->text = $request->text;
		$contactPage->save();

		return redirect('pageTexts')->with('alert-success','Текст на странице Контакты изменен');
	}

}

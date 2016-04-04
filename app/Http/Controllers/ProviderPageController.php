<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ProviderPage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

class ProviderPageController extends Controller {

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
			$text = ProviderPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		return view('pageTexts.edit',['text'=>$text, 'id'=>$id, 'page'=>'Для поставщиков']);
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
			$providerPage = ProviderPage::findOrFail($id);
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

		$providerPage->text = $request->text;
		$providerPage->save();

		return redirect('pageTexts')->with('alert-success','Текст на странице Для поставщиков изменен');
	}
}

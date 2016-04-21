<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\AboutPage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Storage;
use Validator;

class AboutPageController extends Controller {

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
			$text = AboutPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('pageTexts.edit',['text'=>$text, 'id'=>$id, 'page'=>'О компании']);
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
			$aboutPage = AboutPage::findOrFail($id);
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

		$aboutPage->text = $request->text;
		$aboutPage->save();

		return redirect('pageTexts')->with('alert-success','Текст на странице О компании изменен');
	}
}

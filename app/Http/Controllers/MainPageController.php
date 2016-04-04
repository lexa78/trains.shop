<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\MainPage;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Validator;

class MainPageController extends Controller {

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
			$text = MainPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		return view('pageTexts.edit',['text'=>$text, 'id'=>$id, 'page'=>'Главная']);
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
			$mainPage = MainPage::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}

		$validationRules = [
			'text' => 'required',
			'l_p_text' => 'required',
			'r_p_text' => 'required',
		];

		$v = Validator::make($request->all(), $validationRules);

		if ($v->fails())
		{
			return redirect()->back()->withErrors($v->errors())->withInput();
		}

		$mainPage->text = $request->text;
		$mainPage->l_p_text = $request->l_p_text;
		$mainPage->r_p_text = $request->r_p_text;
		$mainPage->save();

		return redirect('pageTexts')->with('alert-success','Текст на Главной странице изменен');
	}

}

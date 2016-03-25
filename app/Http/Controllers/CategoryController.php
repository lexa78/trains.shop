<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('admin');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$categories = Category::all();

		return view('categories.index',['categories'=>$categories]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('categories.create',['cat'=>null]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Category $category, StoreCategory $request)
	{
		$category -> create($request->all());
		return redirect('categories')->with('alert-success', 'Категория успешно добавлена!');
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
			$category = Category::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		return view('categories.edit',['cat'=>$category->category, 'id'=>$category->id]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(StoreCategory $request, $id)
	{
		try{
			$category = Category::findOrFail($id);
		} catch(ModelNotFoundException $e) {
			abort(404);
		}
		$category->update($request->all());
		$category->save();
		return redirect('categories')->with('alert-success','Название группы товаров обновлено');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = Category::find($id);
		$category->delete();
		//Region::destroy($id);
		return back()->with('alert-success','Название группы '. $category->category .' удалено');
	}

}

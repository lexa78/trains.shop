<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreRegion extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route('regions');
		return [
			'reg_name' => 'required|alpha_spaces|max:30|unique:regions,reg_name,'.$id,
		];
	}

}

<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreCondition extends Request {

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
		$id = $this->route('conditions');
		return [
			'condition' => 'required|alpha_spaces_numbers|max:35|unique:conditions,condition,'.$id,
		];
	}

}

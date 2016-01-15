<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreStatus extends Request {

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
		$id = $this->route('statuses');
		return [
			'status' => 'required|chars_numbers_spaces_dot|max:100|unique:statuses,status,'.$id,
			'is_first' => 'integer',
		];
	}

}

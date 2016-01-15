<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreFactory extends Request {

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
		$id = $this->route('factories');
		return [
			'factory_name' => 'required|alpha_spaces_numbers|max:35|unique:factories,factory_name,'.$id,
			'factory_code' => 'required|alpha_dash|max:15',
		];
	}

}

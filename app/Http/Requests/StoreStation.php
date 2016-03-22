<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreStation extends Request {

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
		$id = $this->route('stations');
		return [
			'stantion_name' => 'required|alpha_spaces_numbers_etc|max:35|unique:stantions,stantion_name,'.$id,
			'train_road_id' => 'required|integer',
		];
	}

}

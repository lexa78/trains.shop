<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreTrainRoads extends Request {

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
		$id = $this->route('trainRoads');
		return [
			'tr_name' => 'required|alpha_spaces_numbers|max:35|unique:train_roads,tr_name,'.$id,
			'region_id' => 'required|integer',
		];
	}

}

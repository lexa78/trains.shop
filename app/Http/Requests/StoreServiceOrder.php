<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreServiceOrder extends Request {

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
		return [
            'more_info' => 'required|alpha_spaces_numbers_etc',
            'station_names' => 'required_if:need_station,1|alpha_spaces_numbers_etc',
            'service_id' => 'required|integer',
		];
	}

}

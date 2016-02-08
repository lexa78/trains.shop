<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class StoreOrder extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user()->id;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'oferta' => 'accepted',
            'userID'=>'integer|required|in:'.Auth::user()->id,
		];
	}

}

<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;
class UpdateFirm extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return Auth::user();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'full_organisation_name' => 'required|chars_numbers_spaces|max:255',
			'organisation_name' => 'required|chars_numbers_spaces|max:255',
			'okpo' => 'required|only_numbers_like_string|max:10|min:10',
			'ogrn' => 'required|only_numbers_like_string|max:13|min:13',
			'inn' => 'required|only_numbers_like_string|max:13|min:13',
			'kpp' => 'required|only_numbers_like_string|max:9|min:9',
			'rs' => 'required|only_numbers_like_string|max:20|min:20',
			'bik' => 'required|only_numbers_like_string|max:9|min:9',
			'bank' => 'required|chars_numbers_spaces_dot|max:255',
			'ks' => 'required|only_numbers_like_string|max:20|min:20',
			'face_position' => 'required|alpha_spaces|max:255',
			'face_fio' => 'required|alpha_spaces|max:255',
			'base_document' => 'required|chars_numbers_spaces_dot_numberSymbol|max:255',
			'place_address' => 'required|chars_numbers_spaces_dot|max:255',
			'post_address' => 'required|chars_numbers_spaces_dot|max:255',
			'contact_face_fio' => 'required|alpha_spaces|max:255',
			'accountant_fio' => 'alpha_spaces|max:255',
			'phone' => 'required|numbers_brackets_defis_spaces|max:20',
		];
	}

}

<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class UploadDocument extends Request {

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
			'order_id' => 'required|integer',
			'document_for' => 'required|alpha',
            'docType' => 'required|integer',
            'docFileName' => 'required|mimes:pdf,gif,jpeg,pjpeg,png,bmp,svg+xml'
		];
	}

}

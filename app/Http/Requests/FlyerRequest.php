<?php

namespace App\Http\Requests;

class FlyerRequest extends Request
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * Changed to true...
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
			'street'      => 'required',
			'city'        => 'required',
			'zip'         => 'required',
			'country'     => 'required',
			'state'       => 'required',
			'price'       => 'required',
			'description' => 'required'
		];
	}
}

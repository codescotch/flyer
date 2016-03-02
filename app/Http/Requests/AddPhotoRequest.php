<?php

namespace App\Http\Requests;

use App\Flyer;

class AddPhotoRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Flyer::where([
            // changed $request to $this since we're in an extended request class
            'zip'     => $this->zip,
            'street'  => $this->street,
            // can access the user through the request object
            'user_id' => $this->user()->id
        ])->exists();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ];
    }
}

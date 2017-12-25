<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class UserPasswordRequest extends FormRequest
{
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
            'password' => 'required|max:16|min:6',
            'new_password' => 'required|confirmed|max:16|min:6',
            'new_password_confirmation' => 'required|max:16|min:6'
        ];
    }
}

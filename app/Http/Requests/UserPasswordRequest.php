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
            'password' => 'required_with:new_password|password|max:16|min:5',
            'new_password' => 'confirmed|max:16|min:5',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Dingo\Api\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'location_id' => 'required|exists:locations,id',
            'title' => 'required|max:140',
            'description' => 'required|max:10000',
            'price' => 'required|numeric',
            'images' => 'required|array|min:1|max:3',
            'images.*' => 'required|numeric|exists:images,id',
            'category' => 'required|numeric|exists:categories,id',
            'status' => 'in:active,draft',
        ];
    }
}

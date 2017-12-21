<?php

namespace App\Http\Requests;

use App\Post;
use Illuminate\Foundation\Http\FormRequest;

class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->guard()->user();

        if ($user->is_superadmin) {
            return true;
        }

        $post = Post::findOrFail($this->get('id'));

        return $user->owns($post);
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
            'price' => 'required|numeric'
        ];
    }
}

<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdatePost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.post.edit', $this->post);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['sometimes', 'string'],
            'perex' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'enabled' => ['sometimes', 'boolean'],

            'author_id' => ['nullable',],
        ];
    }
}

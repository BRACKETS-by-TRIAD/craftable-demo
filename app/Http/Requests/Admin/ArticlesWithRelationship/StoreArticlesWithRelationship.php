<?php

namespace App\Http\Requests\Admin\ArticlesWithRelationship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreArticlesWithRelationship extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.articles-with-relationship.create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'perex' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'enabled' => ['required', 'boolean'],
            'author' => ['required'],
            'tags' => ['required']

        ];
    }

    public function getAuthorId()
    {
        if ($this->has('author')) {
            return $this->get('author')['id'];
        }
        return null;
    }

    public function getTags(): array
    {
        if ($this->has('tags')) {
            $tags = $this->get('tags');
            return array_column($tags, 'id');
        }
        return [];
    }
}

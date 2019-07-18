<?php namespace App\Http\Requests\Admin\ArticlesWithRelationship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class StoreArticlesWithRelationship extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.articles-with-relationship.create');
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'perex' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'enabled' => ['required', 'boolean'],
            'author_id' => ['required'],
            
        ];
    }
}

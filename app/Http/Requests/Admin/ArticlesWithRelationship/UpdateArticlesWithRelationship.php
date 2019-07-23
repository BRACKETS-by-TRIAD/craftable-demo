<?php namespace App\Http\Requests\Admin\ArticlesWithRelationship;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateArticlesWithRelationship extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.articles-with-relationship.edit', $this->articlesWithRelationship);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        return [
            'title' => ['sometimes', 'string'],
            'perex' => ['nullable', 'string'],
            'published_at' => ['nullable', 'date'],
            'enabled' => ['sometimes', 'boolean'],
            'author' => ['required'],
            
        ];
    }

    public function getAuthorId(){
        if ($this->has('author')){
            return $this->get('author')['id'];
        }
        return null;
    }
}

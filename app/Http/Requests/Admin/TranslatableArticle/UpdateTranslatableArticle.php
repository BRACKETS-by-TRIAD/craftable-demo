<?php namespace App\Http\Requests\Admin\TranslatableArticle;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdateTranslatableArticle extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.translatable-article.edit', $this->translatableArticle);
    }

/**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return    array
     */
    public function untranslatableRules() {
        return [
            'published_at' => ['nullable', 'date'],
            'enabled' => ['sometimes', 'boolean'],
            
        ];
    }

    /**
     * Get the validation rules that apply to the requests translatable fields.
     *
     * @return    array
     */
    public function translatableRules($locale) {
        return [
            'title' => ['sometimes', 'string'],
            'perex' => ['nullable', 'string'],
            
        ];
    }
}

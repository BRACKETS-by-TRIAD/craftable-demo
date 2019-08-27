<?php

namespace App\Http\Requests\Admin\TranslatableArticle;

use Brackets\Translatable\TranslatableFormRequest;
use Illuminate\Support\Facades\Gate;

class StoreTranslatableArticle extends TranslatableFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('admin.translatable-article.create');
    }

    /**
     * Get the validation rules that apply to the requests untranslatable fields.
     *
     * @return array
     */
    public function untranslatableRules()
    {
        return [
            'published_at' => ['nullable', 'date'],
            'enabled' => ['required', 'boolean'],
            
        ];
    }

    /**
     * Get the validation rules that apply to the requests translatable fields.
     *
     * @param mixed $locale
     * @return array
     */
    public function translatableRules($locale)
    {
        return [
            'title' => ['required', 'string'],
            'perex' => ['nullable', 'string'],
            
        ];
    }
}

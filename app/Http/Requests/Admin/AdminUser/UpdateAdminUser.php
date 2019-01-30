<?php namespace App\Http\Requests\Admin\AdminUser;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;

class UpdateAdminUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return  bool
     */
    public function authorize()
    {
        return Gate::allows('admin.admin-user.edit', $this->adminUser);
    }

/**
     * Get the validation rules that apply to the request.
     *
     * @return  array
     */
    public function rules()
    {
        $rules = [
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'email' => ['sometimes', 'email', Rule::unique('admin_users', 'email')->ignore($this->adminUser->getKey(), $this->adminUser->getKeyName())->whereNull('deleted_at'), 'string'],
            'forbidden' => ['sometimes', 'boolean'],
            'language' => ['sometimes', 'string'],
                
            'roles' => ['sometimes', 'array'],
                
        ];

        if(Config::get('admin-auth.activation_enabled')) {
            $rules['activated'] = ['required', 'boolean'];
        }

        return $rules;
    }

    /**
     * Modify input data
     *
     * @return  array
     */
    public function getModifiedData()
    {
        $data = $this->only(collect($this->rules())->keys()->all());
        //TODO: is this ok?
        if(!Config::get('admin-auth.activation_enabled')) {
            $data['activated'] = true;
        }
        if (array_key_exists('password', $data) && empty($data['password'])) {
            unset($data['password']);
        }
        if(!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        return $data;
    }
}

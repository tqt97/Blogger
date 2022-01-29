<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminEditUserRequest extends FormRequest
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
            'fullName' => 'required',
            'email' => 'bail|email|unique:users,email,' . $this->id,
            'role_id' => 'required'
        ];
    }
    public function message()
    {
        return [
            'fullName.required' => 'Full name is required',
            'email.required' => 'Email is required',
            'email.unique' => 'Email is already exists',
            'role_id.required' => 'User type is required',
        ];
    }
}

<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddUserRequest extends FormRequest
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
            'password' => 'required',
            'email' => 'email|unique:users,email',
            'userType' => 'required',
        ];
    }
    public function message()
    {
        return [
            'fullName.required'=>'Full name is required',
            'email.required'=>'Email is required',
            'password.required'=>'Password is required',
            'email.unique'=>'Email is already exists',
            'userType.required'=>'User type is required',
        ];
    }
}

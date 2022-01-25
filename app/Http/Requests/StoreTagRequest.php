<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
            'tagName' => 'required|unique:tags,tagName'
        ];
    }
    public function message()
    {
        return [
            'required' => 'Tag name is required',
            'unique' => 'Tag name is exist. Please try another tag name.'
        ];
    }
}

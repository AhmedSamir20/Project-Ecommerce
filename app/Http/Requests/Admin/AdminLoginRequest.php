<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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

            'email'=>'required|email|exists:admins',
            'password'=>'required',


        ];
    }

    public function messages()
    {
        return [
            'email.required'=>__('admin/validation.email-required'),
            'email.email'=>__('admin/validation.email-email'),
            'email.exists'=>__('admin/validation.email-exists'),
            'password.required'=>__('admin/validation.password-required'),
        ];
    }
}

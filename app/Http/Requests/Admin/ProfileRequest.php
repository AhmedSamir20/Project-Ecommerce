<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'name'=>'required',
            'email' => 'required|email|unique:admins,email,'.$this -> id,
            'password'=> 'nullable|confirmed|min:8'

            ];
    }

    public function messages()
    {
        return [

            'name.required' => __('admin/editProfile.name.required'),
            'email.required' => __('admin/editProfile.email.required'),
            'email.email' => __('admin/editProfile.email.email'),
            'email.unique' => __('admin/editProfile.email.unique'),
            'password.confirmed' => __('admin/editProfile.password.confirmed'),
            'password.min' => __('admin/editProfile.password.min'),

        ];
    }
}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
             'name' => 'required|unique',
             'photo' => 'required_without:id|mimes:jpg,jpeg,png'
        ];
    }
    public function messages()
    {
        return [
            'photo.required_without' => __('admin/brand.logo.required_without'),
            'photo.mimes' => __('admin/brand.logo.mimes'),
            'name.required' => __('admin/brand.name.required'),
            'name.unique' => __('admin/brand.name.unique'),
        ];
    }

}

<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class tagsRequest extends FormRequest
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
             'name' => 'required',
             'slug' => 'required|unique:tags,slug,'.$this -> id
        ];
    }
    public function messages()
    {
       return[

           'name.required' => __('admin/pages.name.required'),
           'slug.required' => __('admin/pages.slug.required'),
           'slug.unique' => __('admin/pages.name.unique'),

       ];

    }

}

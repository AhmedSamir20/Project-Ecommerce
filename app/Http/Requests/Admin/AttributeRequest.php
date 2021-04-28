<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
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
            //'name' => ['required','max:100',new UniqueAttributeName($this ->name , $this -> id)]
            'name' => 'required|max:100|unique:attribute_translations,name,' . $this->id
        ];
    }

    public function messages()
    {
        return [

            'name.required' => __('admin/pages.name.attribute.required'),
            'name.max' => __('admin/pages.name.name.attribute.max'),
            'name.unique' => __('admin/pages.name.name.attribute.unique'),

        ];

    }
}

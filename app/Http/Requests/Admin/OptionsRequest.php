<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class OptionsRequest extends FormRequest
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
        'name'=>'required|max:100',
        'price'=>'required|numeric|min:0',
        'product_id'=>'required|exists:products,id',
        'attribute_id'=>'required|exists:attributes,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>__('admin/validation.name-option'),
            'name.max'=>__('admin/validation.option-name-max'),
            'price.required'=>__('admin/validation.option-price'),
            'price.numeric'=>__('admin/validation.option-price-numeric'),
            'product_id.exists'=>__('admin/validation.id-product-option'),
            'product_id.required'=>__('admin/validation.name-product-option'),
            'attribute_id.exists'=>__('admin/validation.id-attribute-option'),
            'attribute_id.required'=>__('admin/validation.name-attribute-option'),
        ];
    }
}

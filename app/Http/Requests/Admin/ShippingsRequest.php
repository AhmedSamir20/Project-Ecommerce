<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingsRequest extends FormRequest
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

            'id'=>'required|exists:settings',
            'value'=>'required',
            'plan_value'=>'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [

            'value.required' => __('admin/shipping.value-required'),
            'plain_value.numeric' =>  __('shipping.plain_value-numeric')
        ];
    }
}

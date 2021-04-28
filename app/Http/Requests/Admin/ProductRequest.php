<?php

namespace App\Http\Requests\Admin;

use App\Rules\productQty;
use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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

            'name' => 'required|max:100',
            'slug' => 'required|max:100|unique:products,slug,' . $this->product_id,
            'description' => 'required|max:1000',
            'short_description' => 'nullable|max:500',
            'categories' => 'required|array|min:1',
            'categories.*' => 'numeric|exists:categories,id',
            'tags' => 'required|array',
            'tags.*' => 'numeric|exists:tags,id',
            'brand_id' => 'required|numeric|exists:brands,id',
            'price' => 'nullable|min:0|numeric',
            'special_price' => 'nullable|min:0|numeric',
            'special_price_type' => 'nullable|required_with:special_price|in:fixed,percent',
            'special_price_start' => 'nullable|required_with:special_price|date_format:Y-m-d',
            'special_price_end' => 'nullable|required_with:special_price|date_format:Y-m-d',
            'sku' => 'nullable|min:3|max:10',
            'manage_stock' => 'nullable|in:0,1',
            'in_stock' => 'nullable|in:0,1',
            //'qty'=>'required_if:manage_stock,==,1',
            //==============Custom validation =======
            'qty'=>[new productQty($this->manage_stock)]


        ];
    }

}

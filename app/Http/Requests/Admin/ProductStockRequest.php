<?php

namespace App\Http\Requests\Admin;

use App\Rules\productQty;
use Illuminate\Foundation\Http\FormRequest;

class ProductStockRequest extends FormRequest
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
            'sku' => 'nullable|min:3|Max:10',
            'manage_stock' => 'required|in:0,1',
            'in_stock' => 'required|in:0,1',

            //'qty'=>'required_if:manage_stock,==,1',
            //==============Custom validation =======
            'qty'=>[new productQty($this->manage_stock)]


        ];
    }

}

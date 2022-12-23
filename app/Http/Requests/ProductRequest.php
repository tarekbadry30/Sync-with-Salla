<?php

namespace App\Http\Requests;

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
        switch (request()->method){
            case 'POST':
                return [
                    'sku'           =>'required|string|min:3|unique:products,sku',
                    'name'          =>'required|string|min:3',
                    'description'   =>'required|string|min:3',
                    'image'         =>'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'price'         =>'required|numeric|min:0',
                ];
                break;
            case 'PUT':
                return [
                    'product_id'    => 'required|exists:products,id',
                    'sku'           => 'required|string|min:3|unique:products,sku,'.request()->get('product_id'),
                    'name'          => 'required|string|min:3',
                    'description'   =>'required|string|min:3',
                    'image'         =>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    'price'         =>'required|numeric|min:0',
                ];
                break;
            default:
                return [

                ];
                break;
        }
    }
}

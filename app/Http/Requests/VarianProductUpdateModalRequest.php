<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VarianProductUpdateModalRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'buy_price'=>'required',
            'sell_price'=>'required'
        ];
    }
    public function messages(){
        return [
            'name.required'=>'Nama tidak boleh kosong',
            'buy_price.required'=>'Harga beli tidak boleh kosong',
            'sell_price.required'=>'Harga jual tidak boleh kosong',
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductEmailStoreRequest extends FormRequest
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
            // 'product_id'=>'required',
            'manual_book'=>'required',
            'note'=>'required'
        ];
    }
    public function messages(){
        return [
            // 'product_id.required'=>'Produk id tidak terdeteksi',
            'manual_book.required'=>'Panduan penggunaan tidak boleh kosong',
            'note.required'=>'Catatan tidak boleh kosong'
        ];
    }
}

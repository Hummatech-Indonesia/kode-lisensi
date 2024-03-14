<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VarianProductStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|max:150',
            'name_varian' => 'required|array',
            'name_varian.*' => 'required|max:255',
            'buy_price_varian' => 'required|array',
            'buy_price_varian.*' => 'required|regex:/^[0-9]*$/|integer|min:0',
            'sell_price_varian' => 'required|array',
            'sell_price_varian.*' => 'required',
            'discount_varian' => 'required|regex:/^[0-9]*$/|integer|between:0,100',
            'reseller_discount_varian' => 'required|regex:/^[0-9]*$/|integer|between:0,100',
            'type' => 'required',
            'description' => 'required',
            'features' => 'required',
            'installation' => 'required',
            'photo' => 'required|max:5000|mimes:jpg,png,jpeg',

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            // start varian
            'discount_varian.required'=>'Diskon varian tidak boleh kosong',
            'reseller_discount_varian.required'=>'Diskon varian reseller tidak boleh kosong',
            'name_varian.required'=>'Nama varian tidak boleh kosong',
            'name_varian.*.required' => 'Nama varian pada index ke: :index tidak boleh kosong',
            'buy_price_varian.required'=>'Harga beli varian tidak boleh kosong',
            'buy_price_varian.*.required'=>'Harga beli varian pada index ke: :index tidak boleh kosong',
            'sell_price_varian.required'=>'Harga jual varian tidak boleh kosong',
            'sell_price_varian.*.required'=>'Harga jual varian pada index ke: :index tidak boleh kosong',
            // end varian
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.unique' => 'Nama produk sudah ada',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'category_id.exists' => 'Kategori tidak terdaftar',
            'short_description.required' => 'Deskripsi singkat tidak boleh kosong',
            'short_description.max' => 'Deskripsi singkat maksimal 150 karakter',
            'buy_price.required' => 'Harga beli tidak boleh kosong',
            'buy_price.regex' => 'Harga beli harus berupa angka',
            'buy_price.min' => 'Harga tidak valid',
            'sell_price.required' => 'Harga jual tidak boleh kosong',
            'sell_price.regex' => 'Harga jual harus berupa angka',
            'sell_price.gt' => 'Harga jual harus lebih besar dari harga beli',
            'sell_price.min' => 'Harga tidak valid',
            'discount.required' => 'Diskon tidak boleh kosong',
            'discount.regex' => 'Diskon harus berupa angka',
            'discount.between' => 'Diskon harus rentang 1-100 %',
            'reseller_discount.required' => 'Reseller Diskon tidak boleh kosong',
            'reseller_discount.regex' => 'Reseller Diskon harus berupa angka',
            'reseller_discount.between' => 'Reseller Diskon harus rentang 1-100 %',
            'type.required' => 'Tipe lisensi tidak boleh kosong',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'features.required' => 'Fitur tidak boleh kosong',
            'installation.required' => 'Panduan penggunaan tidak boleh kosong',
            'photo.required' => 'Foto tidak boleh kosong',
            'photo.max' => 'Foto maksimal 5Mb',
            'photo.mimes' => 'Ekstensi foto harus berupa jpg,png,jpeg',
        ];
    }
}

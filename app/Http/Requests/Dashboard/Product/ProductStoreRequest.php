<?php

namespace App\Http\Requests\Dashboard\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Sesuaikan dengan kebijakan otorisasi Anda
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'short_description' => 'required|max:150',
            'buy_price' => 'required|regex:/^[0-9]*$/|integer|min:0',
            'sell_price' => 'required|regex:/^[0-9]*$/|gt:buy_price|integer|min:0',
            'type' => 'required',
            'status' => 'required',
            'description' => 'required',
            'features' => 'required',
            'discount_price' => 'required',
            'installation' => 'required',
            'photo' => 'required|max:5000|mimes:jpg,png,jpeg',
        ];

        if ($this->input('discount_price') == 1) {
            $rules['discount'] = 'required|regex:/^[0-9]*$/|integer';
            $rules['reseller_discount'] = 'required|regex:/^[0-9]*$/|integer';
        } else {
            $rules['discount'] = 'required|regex:/^[0-9]*$/|integer|between:0,100';
            $rules['reseller_discount'] = 'required|regex:/^[0-9]*$/|integer|between:0,100';
        }

        return $rules;
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
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
            'discount.boolean' => 'Diskon harus berupa nilai boolean',
            'reseller_discount.required' => 'Reseller Diskon tidak boleh kosong',
            'reseller_discount.boolean' => 'Reseller Diskon harus berupa nilai boolean',
            'discount.regex' => 'Diskon harus berupa angka',
            'discount.between' => 'Diskon harus rentang 1-100 %',
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

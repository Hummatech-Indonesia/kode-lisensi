<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Http\Requests\BaseRequest;

class ProductUpdateRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|',
            'category_id' => 'required|exists:categories,id',
            'buy_price' => 'required|regex:/^[0-9]*$/|integer|min:0',
            'sell_price' => 'required|regex:/^[0-9]*$/|gt:buy_price|integer|min:0',
            'discount' => 'required|regex:/^[0-9]*$/|integer|between:0,100',
            'reseller_discount' => 'required|regex:/^[0-9]*$/|integer|between:0,100',
            'type' => 'required',
            'status' => 'required',
            'description' => 'required',
            'installation' => 'required',
            'photo' => 'nullable|max:5000|mimes:jpg,png,jpeg',
            'attachment_file' => 'nullable|max:20000|mimes:pdf'
        ];
    }

    /**
     * Custom Validation Messages
     *
     * @return array<string, mixed>
     */

    public function messages()
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'category_id.required' => 'Kategori tidak boleh kosong',
            'category_id.exists' => 'Kategori tidak terdaftar',
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
            'installation.required' => 'Panduan penggunaan tidak boleh kosong',
            'photo.max' => 'Foto maksimal 5Mb',
            'photo.mimes' => 'Ekstensi foto harus berupa jpg,png,jpeg',
            'attachment_file.max' => 'Panduan maksimal 20Mb',
            'attachment_file.mimes' => 'Ekstensi Panduan harus berupa pdf'
        ];
    }
}

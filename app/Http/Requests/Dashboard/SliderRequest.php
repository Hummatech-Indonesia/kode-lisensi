<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class SliderRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'offer' => 'required|max:50',
            'header' => 'required|max:50',
            'sub_header' => 'required|max:50',
            'description' => 'required|max:50',
            'image' => 'nullable|max:5000|mimes:jpg,png,jpeg|image',
            'product_url' => 'required'
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
            'offer.required' => 'Headline Promo tidak boleh kosong',
            'offer.max' => 'Headline Promo maksimal 50 karakter',
            'header.required' => 'Header tidak boleh kosong',
            'header.max' => 'Header maksimal 50 karakter',
            'sub_header.required' => 'Sub Header tidak boleh kosong',
            'sub_header.max' => 'Sub Header maksimal 50 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'description.max' => 'Deskripsi maksimal 50 karakter',
            'image.max' => 'Gambar maksimal 5Mb',
            'image.mimes' => 'Gambar harus berekstensi jpg,png,jpeg',
            'image.image' => 'Gambar tidak valid',
            'product_url' => 'Produk tidak boleh kosong'
        ];
    }
}

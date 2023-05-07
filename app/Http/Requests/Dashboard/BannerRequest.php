<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class BannerRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_offer' => 'required|max:50',
            'first_title' => 'required|max:50',
            'first_description' => 'required|max:50',
            'first_image' => 'nullable|max:5000|mimes:jpg,png,jpeg|image',
            'first_product_url' => 'required',
            'second_offer' => 'required|max:50',
            'second_title' => 'required|max:50',
            'second_description' => 'required|max:50',
            'second_image' => 'nullable|max:5000|mimes:jpg,png,jpeg|image',
            'second_product_url' => 'required'
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
            'first_offer.required' => 'Headline Promo Banner 1 tidak boleh kosong',
            'first_offer.max' => 'Headline Promo Banner 1 maksimal 50 karakter',
            'first_title.required' => 'Judul Banner 1 tidak boleh kosong',
            'first_title.max' => 'Judul Banner 1 maksimal 50 karakter',
            'first_description.required' => 'Deskripsi Banner 1tidak boleh kosong',
            'first_description.max' => 'Deskripsi Banner 1 maksimal 50 karakter',
            'first_image.max' => 'Gambar Banner 1 maksimal 5Mb',
            'first_image.mimes' => 'Gambar Banner 1 harus berekstensi jpg,png,jpeg',
            'first_image.image' => 'Gambar Banner 1 tidak valid',
            'first_product_url' => 'Produk Banner 1 tidak boleh kosong',

            'second_offer.required' => 'Headline Promo Banner 2 tidak boleh kosong',
            'second_offer.max' => 'Headline Promo Banner 2 maksimal 50 karakter',
            'second_title.required' => 'Judul Banner 2 tidak boleh kosong',
            'second_title.max' => 'Judul Banner 2 maksimal 50 karakter',
            'second_description.required' => 'Deskripsi Banner 2tidak boleh kosong',
            'second_description.max' => 'Deskripsi Banner 2 maksimal 50 karakter',
            'second_image.max' => 'Gambar Banner 2 maksimal 5Mb',
            'second_image.mimes' => 'Gambar Banner 2 harus berekstensi jpg,png,jpeg',
            'second_image.image' => 'Gambar Banner 2 tidak valid',
            'second_product_url' => 'Produk Banner 2 tidak boleh kosong'
        ];
    }
}

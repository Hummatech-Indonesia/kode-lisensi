<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class SiteSettingRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'description' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'logo' => 'nullable|max:2048|mimes:jpg,png,jpeg',
            'facebook' => 'required|url',
            'twitter' => 'required|url',
            'youtube' => 'required|url',
            'instagram' => 'required|url'
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'description.required' => 'Deskripsi tidak boleh kosong',
            'phone_number.required' => 'Nomor Telepon tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus valid',
            'logo.max' => 'Logo maksimal 2Mb',
            'logo.mimes' => 'Logo harus berupa jpg, png, jpeg',
            'facebook.required' => 'Facebook tidak boleh kosong',
            'facebook.url' => 'Facebook harus berupa url',
            'twitter.required' => 'Twitter tidak boleh kosong',
            'twitter.url' => 'Twitter harus berupa url',
            'youtube.required' => 'Youtube tidak boleh kosong',
            'youtube.url' => 'Youtube harus berupa url',
            'instagram.required' => 'Instagram tidak boleh kosong',
            'instagram.url' => 'Instagram harus berupa url'
        ];
    }
}

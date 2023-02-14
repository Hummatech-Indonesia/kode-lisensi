<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class ProfileRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|min:3|max:255|regex:/^[a-z-A-Z_\s\.]*$/',
            'phone_number' => 'nullable|max:20|regex:/^[0-9]*$/',
            'photo' => 'nullable|image|max:2048|mimes:jpg,png,jpeg'
        ];
    }

    /**
     * Custom Validation Messages.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama minimal 3 karakter',
            'name.max' => 'Nama maksimal 255 karakter',
            'name.regex' => 'Nama harus berupa karakter valid',
            'phone_number.max' => 'Nomor telepon maksimal 20 digit',
            'phone_number.regex' => 'Nomor telepon harus berupa angka',
            'photo.image' => 'Foto harus berupa angka',
            'photo.max' => 'Foto maksimal 2Mb',
            'photo.mimes' => 'Ekstensi foto harus jpg,png,jpeg'
        ];
    }
}

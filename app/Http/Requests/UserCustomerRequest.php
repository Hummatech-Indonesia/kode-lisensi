<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCustomerRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email',
            'phone_number' => 'required|max:12'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.max' => 'Email maksimal 255 karakter',
            'email.email' => 'Format email tidak valid',
            'phone_number.required' => 'Nomor HP wajib diisi',
            'phone_number.max' => 'Nomor HP maksimal 12 karakter'
        ];
    }
}

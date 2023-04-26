<?php

namespace App\Http\Requests;

class ContactRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:150',
            'phone_number' => 'required|max:20',
            'message' => 'required',
            'g-recaptcha-response' => 'required'
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
            'firstname.required' => 'Nama depan tidak boleh kosong',
            'firstname.max' => 'Nama depan maksimal 100 karakter',
            'lastname.required' => 'Nama belakang tidak boleh kosong',
            'lastname.max' => 'Nama belakang maksimal 100 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus valid',
            'email.max' => 'Email maksimal 150 karakter',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong',
            'phone_number.max' => 'Nomor telepon maksimal 20 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'message.required' => 'Pesan tidak boleh kosong',
            'g-recaptcha-response.required' => 'Captcha tidak boleh kosong'
        ];
    }
}

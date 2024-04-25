<?php


namespace App\Http\Requests;

class TransactionRequest extends BaseRequest
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
            'email' => 'required|email|max:255',
            'phone_number' => 'required|max:50',
            'note'=>'nullable|max:500',
            'g-recaptcha-response' => 'required',
            'payment_code' => 'required'
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
            'name.required' => 'Nama depan tidak boleh kosong',
            'name.max' => 'Nama depan maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email harus valid',
            'email.max' => 'Email maksimal 255 karakter',
            'phone_number.required' => 'Nomor telepon tidak boleh kosong',
            'phone_number.max' => 'Nomor telepon maksimal 50 karakter',
            'note.max'=>'Catatan pemesanan maksimal 500 karakter',
            'password.required' => 'Password tidak boleh kosong',
            'g-recaptcha-response.required' => 'Captcha tidak boleh kosong',
            'payment_code.required' => 'Jenis Pembayaran harus diisi'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\UserRoleRule;
use Illuminate\Foundation\Http\FormRequest;

class TransactionWhatsappRequest extends FormRequest
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
            'phone_number' => 'required|max:255',
            'email' => 'required|max:255|email',
            'role' => ['required', new UserRoleRule],
            'payment_method'=>'required',
        ];
    }

    /**
     * messages
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'phone_number.required' => 'Nomor telepon harus diisi.',
            'phone_number.max' => 'Nomor telepon tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email harus diisi.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'email.email' => 'Alamat email harus berupa alamat email yang valid.',
            'product_id.required' => 'ID produk harus diisi.',
            'product_id.exists' => 'ID produk yang dipilih tidak valid.',
            'varian_product_id.required' => 'ID varian produk harus diisi.',
            'varian_product_id.exists' => 'ID varian produk yang dipilih tidak valid.',
            'payment_method.required'=>'Pilih metode pembayaran',
        ];
    }
}

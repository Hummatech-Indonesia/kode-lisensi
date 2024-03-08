<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIdInvoiceRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'new_invoice' => ['required', 'regex:/^[0-9]{4}$/', 'size:4'],
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages(): array
    {
        return [
            'new_invoice.required' => 'Nomor Invoice wajib diisi',
            'new_invoice.min' => 'Nomor Invoice harus 4 karakter',
            'new_invoice.max' => 'Nomor Invoice harus 4 karakter',
        ];
    }
}

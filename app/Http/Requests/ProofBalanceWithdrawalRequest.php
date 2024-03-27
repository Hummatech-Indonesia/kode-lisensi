<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProofBalanceWithdrawalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'proof' => 'required|mimes:png,jpg,jpeg',
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
            'proof.required' => 'Bukti wajib diisi',
            'proof.mimes' => 'Format foto tidak diizinkan'
        ];
    }
}

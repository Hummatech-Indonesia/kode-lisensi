<?php

namespace App\Http\Requests;

use App\Rules\BalanceUsedRule;
use Illuminate\Foundation\Http\FormRequest;

class ApproveRefundRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'balance_used' => ['required', new BalanceUsedRule],
            'description' => 'required',
            'proof_admin' => 'required|mimes:png,jpg,jpeg'
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
            'balance_used.required' => 'Metode pembayaran wajib diisi',
            'description.required' => 'Deskripsi wajib diisi',
            'proof_admin.required' => 'Bukti pembayaran wajib diisi',
            'proof_admin.mimes' => 'Bukti pembayaran harus berformat png, jpg, jpeg'
        ];
    }
}

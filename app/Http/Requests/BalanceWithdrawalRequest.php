<?php

namespace App\Http\Requests;

use App\Rules\ViaRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BalanceWithdrawalRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'balance' => 'required|max:25',
            'pin' => [
                'required',
                Rule::exists('pin_rekenings', 'pin')->where(function ($query) {
                    return $query->where('user_id', auth()->id());
                }),
            ],
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
            'via.required' => 'Kolom via harus diisi.',
            'rekening_number.required' => 'Kolom nomor rekening harus diisi.',
            'rekening_number.max' => 'Input maksimal kolom rekening adalah 25',
            'balance.required' => 'Tentukan jumlah saldo penarikan',
            'balance.integer' => 'Saldo harus dalam bentuk angka.',
            'balance.min' => 'Saldo minimal harus Rp 50.000.',
            'pin.required' => 'Pin wajib diisi',
            'pin.exists' => 'Pin tidak sesuai'
        ];
    }
}

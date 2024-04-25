<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenditureRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'used_for'=>'required',
            'balance_used'=>'required',
            'balance_withdrawn'=>'required',
            'description'=>'required',
        ];
    }
    public function messages(){
        return [
            'used_for.required'=>'Tujuan pengeluaran harus terisi',
            'balance_used.required'=>'Tentukan rekening yang akan anda gunakan',
            'balance_withdrawn.required'=>'Nominal pengeluaran harus terisi',
            'description.required'=>'Kolom Deskripsi tidak boleh kosong',
        ];
    }
}

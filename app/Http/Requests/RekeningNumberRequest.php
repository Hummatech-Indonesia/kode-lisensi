<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RekeningNumberRequest extends FormRequest
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
            'name'=>'required',
            'rekening'=>'required',
            'rekening_number'=>'required'
        ];
    }
    public function messages():array{
        return [
            'name.required'=>'Nama pemilik tidak boleh kosong',
            'rekening.required'=>'Nama bank tidak boleh kosong',
            'rekening_number.required'=>'Nomor rekening tidak boleh kosong'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PinRekeningRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'pin' => 'required|size:6',
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
            'pin.required' => 'Pin wajib diisi.',
            'pin.size'=>'Karakter pin harus berjumlah :size.'
        ];
    }
}

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
            'pin' => 'required|max:6',
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
            'pin.max'=>'Karakter maksimal pin adalah :max.'
        ];
    }
}

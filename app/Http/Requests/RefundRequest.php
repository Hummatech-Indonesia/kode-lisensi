<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RefundRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'description' => 'required|max:225',
            'proof' => 'required|mimes:png,jpg,jpeg',
            'bank' => 'required|max:225',
            'rekening_number' => 'required|max:225'
        ];
    }
}

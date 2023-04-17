<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class TermRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'term' => 'required',
            'privacy' => 'required'
        ];
    }

    /**
     * Custom Validation Messages
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'term.required' => 'Syarat dan ketentuan tidak boleh kosong',
            'privacy.required' => 'Kebijakan penggunaan tidak boleh kosong'
        ];
    }
}

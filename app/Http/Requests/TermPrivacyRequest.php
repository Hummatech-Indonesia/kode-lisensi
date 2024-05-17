<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TermPrivacyRequest extends FormRequest
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
            'term' => 'required',
            'privacy' => 'required',
        ];
    }
    /**
     * Method messages
     *
     * @return void
     */
    public function messages()
    {
        return [
            'term.required' => 'Syarat tidak boleh kosong',
            'privacy.required' => 'Kebijakan tidak boleh kosong'
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class HelpRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'answer' => 'required',
            'question' => 'required'
        ];
    }

    /**
     * Get the validation messages.
     *
     * @return array<string, mixed>
     */

    public function messages(): array
    {
        return [
            'answer.required' => 'Pertanyaan tidak boleh kosong',
            'question.required' => 'Jawaban tidak boleh kosong',
        ];
    }
}

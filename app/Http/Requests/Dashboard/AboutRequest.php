<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class AboutRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:100',
            'content' => 'required'
        ];
    }

    /**
     * Validation custom Messages.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'title.required' => 'Judul tidak boleh kosong',
            'title.max' => 'Judul Maksimal 100 karakter',
            'content.required' => 'Konten tidak boleh kosong'
        ];
    }
}

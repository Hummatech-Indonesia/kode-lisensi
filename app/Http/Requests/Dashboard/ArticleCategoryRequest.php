<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class ArticleCategoryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:150'
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
            'name.required' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 150 karakter'
        ];
    }
}

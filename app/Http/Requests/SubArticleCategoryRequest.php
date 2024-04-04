<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubArticleCategoryRequest extends FormRequest
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
            'name' => 'required|unique:sub_article_categories,name',
        ];
    }
    /**
     * Method messages
     *
     * @return void
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kolom nama sub kategori harus diisi',
            'name.unique' => 'Nama sub-kategori sudah ada',
        ];
    }
}

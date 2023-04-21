<?php

namespace App\Http\Requests\Dashboard\Product;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class ProductQuestionRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'question' => 'required',
            'answer' => 'required',
            'product_id' => ['required', Rule::exists('products', 'id')]
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return [
            'question.required' => 'Pertanyaan tidak boleh kosong',
            'answer.required' => 'Jawaban tidak boleh kosong',
            'product_id.required' => 'Produk tidak boleh kosong',
            'product_id.exists' => 'Produk tidak valid'
        ];
    }
}

<?php

namespace App\Http\Requests;

class RatingRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules(): array
    {
        return [
            'rating' => 'required|regex:/^[0-9]*$/|integer|between:1,5',
            'review' => 'required',
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
            'rating.required' => 'Rating tidak boleh kosong',
            'rating.regex' => 'Rating harus berupa angka',
            'rating.between' => 'Rating harus dalam rentang 1-5 poin',
            'review.required' => 'Ulasan tidak boleh kosong'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRecommendationRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date'
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
            'start_date.required' => 'Tangal dimulai wajib diisi',
            'start_date.date' => 'Format tanggal dimulai tidak valid',
            'start_date.after_or_equal' => 'Tanggal dimulai tidak boleh sebelum hari ini',
            'end_date.required' => 'Tangal berakhir wajib diisi',
            'end_date.date' => 'Format tanggal berakhir tidak valid',
            'end_date.after_or_equal' => 'Tanggal berakhir tidak boleh sebelum tanggal dimulai',
        ];
    }
}

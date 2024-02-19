<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FcmTokenRequest extends ApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'fcm_token' => 'required'
        ];
    }
}

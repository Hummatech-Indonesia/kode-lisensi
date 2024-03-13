<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;

class LicenseRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'username' => 'nullable',
            'description'=>'nullable',
            'password' => 'nullable',
            'serial_key' => 'nullable'
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
            'username.required' => 'Username tidak boleh kosong',
            'description.required' => 'Description tidak boleh kosong',
            'password.required' => 'Password tidak boleh kosong',
            'serial_key.required' => 'Serial key tidak boleh kosong'
        ];
    }
}

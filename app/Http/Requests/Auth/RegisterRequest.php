<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\BaseRequest;
use App\Rules\UserRoleRule;
use Illuminate\Validation\Rule;

class RegisterRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => ['required', 'max:255', Rule::unique('users', 'email')],
            'password' => 'required|min:6|confirmed',
            'g-recaptcha-response' => 'required',
            'checkbox-term' => 'required',
            'phone_number' => 'required|max:12'
        ];
    }

    /**
     * Get the validation rules message.
     *
     * @return array
     */

    public function messages(): array
    {
        return [
            'name.required' => 'Nama harus diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email telah digunakan',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Password tidak cocok',
            'role.required' => 'Role tidak boleh kosong',
            'g-recaptcha-response.required' => 'Captcha harus diisi',
            'checkbox-term.required' => 'Syarat dan ketentuan harus dicentang'
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Rules\AdminRoleRule;
use App\Rules\UserRoleRule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => 'nullable|min:8',
            'role' => ['required', new AdminRoleRule],
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
            'name.required' => 'Nama wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email telah digunakan',
            'password.min' => 'Password minimal 8 karakter',
            'role.required' => 'Role wajib diisi'
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', Rule::unique('categories', 'name')->ignore($this->category)],
            'icon' => 'nullable|image|max:2048|mimes:jpg,png,jpeg',
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
            'name.unique' => 'Nama tidak boleh kosong',
            'name.max' => 'Nama maksimal 255 karakter',
            'icon.image' => 'Icon harus berupa gambar',
            'icon.max' => 'Icon maksimal 2Mb',
            'icon.mimes' => 'Ekstensi icon jpg,png,jpeg'
        ];
    }
}

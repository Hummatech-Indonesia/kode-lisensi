<?php

namespace App\Rules;

use App\Enums\UserRoleEnum;
use Illuminate\Contracts\Validation\Rule;

class AdminRoleRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array($value, [UserRoleEnum::ADMIN->value, UserRoleEnum::AUTHOR->value, UserRoleEnum::RESELLER->value]);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Role tidak sesuai';
    }
}

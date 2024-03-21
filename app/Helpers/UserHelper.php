<?php

namespace App\Helpers;

use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserHelper
{
    /**
     * Handle get user role
     *
     * @return string
     */

    public static function getUserRole(): string
    {
        if (auth()->user()) {
            return auth()->user()->roles->pluck('name')[0];
        } else {
            return 'Anda belum login';
        }
    }

    /**
     * Handle get username
     *
     * @return string
     */

    public static function getUserName(): string
    {
        return auth()->user()->name;
    }

    /**
     * Handle get email
     *
     * @return string
     */

    public static function getUserEmail(): string
    {
        return auth()->user()->email;
    }

    /**
     * Handle get phone_number
     *
     * @return string
     */

    public static function getUserPhone(): string
    {
        return auth()->user()->phone_number ?? 'Nomor belum terdaftar';
    }

    /**
     * Handle get photo
     *
     * @return string|null
     */

    public static function getUserPhoto(): string|null
    {
        return auth()->user()->photo;
    }

    /**
     * Handle get all administrators
     *
     * @return object
     */

    public static function getAllAdministrators(): object
    {
        return User::query()
            ->role(UserRoleEnum::ADMIN->value)
            ->get();
    }

    /**
     * Handle instantly get user
     *
     * @param string $id
     *
     * @return Model
     */

    public static function instantGetUser(string $id): Model
    {
        return User::query()->findOrFail($id);
    }

    /**
     * Handle count resellers
     *
     * @return int
     */

    public static function countResellers(): int
    {
        return User::query()
            ->role(UserRoleEnum::RESELLER->value)
            ->count();
    }

    /**
     * Handle count customers
     *
     * @return int
     */

    public static function countCustomers(): int
    {
        return User::query()
            ->role(UserRoleEnum::CUSTOMER->value)
            ->count();
    }
}

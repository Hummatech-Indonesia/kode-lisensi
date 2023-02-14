<?php

namespace App\Helpers;

class UserHelper
{
    /**
     * Handle get user role
     *
     * @return string
     */

    public static function getUserRole(): string
    {
        return auth()->user()->roles->pluck('name')[0];
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
     * Handle get photo
     *
     * @return string|null
     */

    public static function getUserPhoto(): string|null
    {
        return auth()->user()->photo;
    }
}

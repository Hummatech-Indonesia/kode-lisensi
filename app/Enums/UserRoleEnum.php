<?php

namespace App\Enums;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case RESELLER = 'reseller';
    case CUSTOMER = 'customer';
    case AUTHOR = 'author';
    case ADMINISTRATOR = 'administrator';
}

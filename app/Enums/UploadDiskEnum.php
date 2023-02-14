<?php

namespace App\Enums;

enum UploadDiskEnum: string
{
    case PRODUCTS = 'products';
    case CATEGORIES = 'categories';
    case PROFILES = 'profiles';
}

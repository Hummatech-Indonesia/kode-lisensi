<?php

namespace App\Enums;

enum UploadDiskEnum: string
{
    case PRODUCTS = 'products';
    case CATEGORIES = 'categories';
    case PROFILES = 'profiles';
    case PRODUCT_ATTACHMENTS = 'product_attachments';
    case SITE_SETTING = 'site_setting';
    case ARTICLES = 'articles';
    case SLIDERS = 'sliders';
    case BANNERS = 'banners';
    case PROOF = 'proof';
    case ABOUT = 'about';
}

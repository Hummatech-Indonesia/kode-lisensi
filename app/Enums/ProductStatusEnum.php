<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case AVAILABLE = 'stocking';
    case PREORDER = 'preorder';
}



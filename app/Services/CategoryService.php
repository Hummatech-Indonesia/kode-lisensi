<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Traits\UploadTrait;

class CategoryService implements ShouldHandleFileUpload
{
    use UploadTrait;
}

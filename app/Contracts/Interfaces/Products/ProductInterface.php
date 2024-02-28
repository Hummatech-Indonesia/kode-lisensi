<?php

namespace App\Contracts\Interfaces\Products;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\CursorPaginateInterface;
use App\Contracts\Interfaces\Eloquent\GetAllnterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\ShowSlugInterface;
use App\Contracts\Interfaces\Eloquent\ShowSoftDeleteInterface;
use App\Contracts\Interfaces\Eloquent\SoftDeleteInterface;

interface ProductInterface extends BaseInterface, SoftDeleteInterface, PreorderProductInterface, ShowSoftDeleteInterface, CursorPaginateInterface, ShowSlugInterface, GetAllnterface,GetWhereInterface
{
}

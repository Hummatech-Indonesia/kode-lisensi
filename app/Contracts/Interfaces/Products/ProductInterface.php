<?php

namespace App\Contracts\Interfaces\Products;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\CursorPaginateInterface;
use App\Contracts\Interfaces\Eloquent\ShowSoftDeleteInterface;
use App\Contracts\Interfaces\Eloquent\SoftDeleteInterface;

interface ProductInterface extends BaseInterface, SoftDeleteInterface, PreorderProductInterface, ShowSoftDeleteInterface, CursorPaginateInterface
{

}

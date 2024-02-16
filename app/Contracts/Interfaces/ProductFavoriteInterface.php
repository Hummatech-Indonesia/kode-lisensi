<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface ProductFavoriteInterface extends GetInterface, StoreInterface, DeleteInterface, GetWhereInterface
{
}

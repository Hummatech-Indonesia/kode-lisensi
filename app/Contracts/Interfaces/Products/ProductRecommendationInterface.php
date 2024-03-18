<?php

namespace App\Contracts\Interfaces\Products;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface ProductRecommendationInterface extends  StoreInterface,DeleteInterface
{
}

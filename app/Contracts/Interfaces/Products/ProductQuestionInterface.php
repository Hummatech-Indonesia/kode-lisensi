<?php

namespace App\Contracts\Interfaces\Products;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ProductQuestionInterface extends GetInterface, StoreInterface, UpdateInterface, DeleteInterface
{

}

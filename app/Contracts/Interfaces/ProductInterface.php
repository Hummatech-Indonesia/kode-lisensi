<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\SoftDeleteInterface;

interface ProductInterface extends BaseInterface, SoftDeleteInterface
{

}

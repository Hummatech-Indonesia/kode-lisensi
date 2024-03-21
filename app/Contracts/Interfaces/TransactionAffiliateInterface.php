<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface TransactionAffiliateInterface extends StoreInterface, GetWhereInterface
{
}

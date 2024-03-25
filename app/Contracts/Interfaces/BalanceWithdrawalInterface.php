<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;

interface BalanceWithdrawalInterface extends StoreInterface, GetInterface, SearchInterface
{
}

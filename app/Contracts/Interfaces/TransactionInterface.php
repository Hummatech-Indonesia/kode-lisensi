<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\GetAllnterface;

interface TransactionInterface extends GetInterface, StoreInterface, ShowInterface, GetAllnterface
{
    /**
     * Handle the apiGetHistory all data event from models.
     *
     * @return mixed
     */

    public function apiGetHistory(): mixed;

    /**
     * Handle the apiGet all data event from models.
     *
     * @return mixed
     */

    public function apiGetPreorder(): mixed;
}

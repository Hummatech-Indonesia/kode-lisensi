<?php

namespace App\Contracts\Interfaces\Administrator;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetAllnterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface RefundInterface extends StoreInterface, GetInterface, UpdateInterface, DeleteInterface, ShowInterface,GetAllnterface
{
    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getMyRefund(): mixed;
}

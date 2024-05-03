<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\GetAllnterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Traits\Datatables\ExpenditureDatatable;

interface TransactionInterface extends GetInterface, StoreInterface, ShowInterface, GetAllnterface,SearchInterface
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

    /**
     * getInvoice
     *
     * @return mixed
     */
    public function getInvoice(): mixed;
    /**
     * Method getPending
     *
     * @return mixed
     */
    public function getPending(): mixed;

    /**
     * findNow
     *
     * @return mixed
     */
    public function findNow(mixed $id): mixed;
}

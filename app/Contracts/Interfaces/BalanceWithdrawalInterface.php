<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use Illuminate\Http\Request;

interface BalanceWithdrawalInterface extends StoreInterface, SearchInterface
{
    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

     public function getHistory(): mixed;


     public function getHistories(Request $request):mixed;
}

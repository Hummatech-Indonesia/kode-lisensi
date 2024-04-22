<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface UserInterface extends StoreInterface, GetInterface, GetWhereInterface, UpdateInterface, DeleteInterface, ShowInterface, SearchInterface
{

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function searchByEmail(mixed $email): mixed;
}

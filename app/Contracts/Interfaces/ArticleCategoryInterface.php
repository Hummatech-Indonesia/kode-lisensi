<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ArticleCategoryInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface
{
    /**
     * count
     *
     * @return int
     */
    public function count(): int;

    /**
     * getWhereHas
     *
     * @return mixed
     */
    public function getWhereHas(): mixed;
}

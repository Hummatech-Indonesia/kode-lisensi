<?php

namespace App\Contracts\Interfaces\Products;

use App\Contracts\Interfaces\Eloquent\BaseInterface;
use App\Contracts\Interfaces\Eloquent\CursorPaginateInterface;
use App\Contracts\Interfaces\Eloquent\GetAllnterface;
use App\Contracts\Interfaces\Eloquent\GetWhereInterface;
use App\Contracts\Interfaces\Eloquent\SearchInterface;
use App\Contracts\Interfaces\Eloquent\ShowSlugInterface;
use App\Contracts\Interfaces\Eloquent\ShowSoftDeleteInterface;
use App\Contracts\Interfaces\Eloquent\SoftDeleteInterface;

interface ProductInterface extends BaseInterface, SoftDeleteInterface, PreorderProductInterface, ShowSoftDeleteInterface, CursorPaginateInterface, ShowSlugInterface, GetAllnterface, GetWhereInterface, SearchInterface
{
    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function showCategory(mixed $id): mixed;

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getProductRecommendation(): mixed;
}

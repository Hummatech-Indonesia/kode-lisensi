<?php

namespace App\Contracts\Interfaces;

use App\Base\Interfaces\Notification\CountInterface;
use App\Contracts\Interfaces\Eloquent\CustomPaginationInterface;
use App\Contracts\Interfaces\Eloquent\DeleteInterface;
use App\Contracts\Interfaces\Eloquent\GetInterface;
use App\Contracts\Interfaces\Eloquent\ShowInterface;
use App\Contracts\Interfaces\Eloquent\ShowSlugInterface;
use App\Contracts\Interfaces\Eloquent\StoreInterface;
use App\Contracts\Interfaces\Eloquent\UpdateInterface;

interface ArticleInterface extends GetInterface, StoreInterface, UpdateInterface, ShowInterface, DeleteInterface, CustomPaginationInterface, ShowSlugInterface
{
    /**
     * count
     *
     * @return int
     */
    public function count(): int;

    /**
     * getByUser
     *
     * @return int
     */
    public function getByUser(): mixed;
    /**
     * Method getByTag
     *
     * @param string $tag [explicite description]
     *
     * @return mixed
     */
    public function getByTag(string $tag):mixed;
}

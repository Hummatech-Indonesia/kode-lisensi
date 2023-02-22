<?php

namespace App\Contracts\Interfaces\Products;

use Exception;

interface PreorderProductInterface
{
    /**
     * Handle the Get all preorder data event from models.
     *
     * @return mixed
     * @throws Exception
     */

    public function preorder(): mixed;
}

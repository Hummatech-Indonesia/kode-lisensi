<?php

namespace App\Contracts\Interfaces;

use App\Contracts\Interfaces\Eloquent\BaseInterface;

interface SubArticleCategoryInterface extends BaseInterface
{
    /**
     * Method GetCategory
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function getCategory(mixed $id):mixed;
}

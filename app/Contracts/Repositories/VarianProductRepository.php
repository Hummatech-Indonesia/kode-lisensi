<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\VarianProductInterface;
use App\Models\Category;
use App\Models\VarianProduct;
use Illuminate\Database\QueryException;

class VarianProductRepository extends BaseRepository implements VarianProductInterface
{
    public function __construct(VarianProduct $varianProduct)
    {
        $this->model = $varianProduct;
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getWhere(array $data): mixed
    {
        return $this->model->query()
            ->where('product_id', $data['product_id'])
            ->where('slug', $data['slug_varian'])
            ->first();
    }
}

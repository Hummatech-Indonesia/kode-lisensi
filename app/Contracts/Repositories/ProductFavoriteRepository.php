<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ProductFavoriteInterface;
use App\Models\ProductFavorite;
use Illuminate\Database\QueryException;

class ProductFavoriteRepository extends BaseRepository implements ProductFavoriteInterface
{
    public function __construct(ProductFavorite $productFavorite)
    {
        $this->model = $productFavorite;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
    }

    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->findOrFail($id)
            ->delete();
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
            ->where('user_id', $data['user_id'])
            ->where('product_id', $data['product_id'])
            ->first();
    }
}

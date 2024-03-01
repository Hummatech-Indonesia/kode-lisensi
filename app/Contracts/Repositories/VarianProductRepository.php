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
    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

     public function delete(mixed $id): mixed{
        return $this->show($id)->delete();
     }
     /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */

    public function show(mixed $id): mixed{
        return $this->model->query()->findOrFail($id);
    }
    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */

     public function update(mixed $id, array $data): mixed{
        return $this->show($id)->update($data);
     }
}

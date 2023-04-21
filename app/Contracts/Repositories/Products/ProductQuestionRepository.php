<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ProductQuestionInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\ProductQuestion;
use App\Traits\Datatables\ProductQuestionDatatable;
use Exception;

class ProductQuestionRepository extends BaseRepository implements ProductQuestionInterface
{
    use ProductQuestionDatatable;

    public function __construct(ProductQuestion $product)
    {
        $this->model = $product;
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->delete();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */

    public function get(): mixed
    {
        return $this->ProductQuestionMockup($this->model->query());
    }

    /**
     * Handle store data event to models.
     *
     * @param array $data
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
    }
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ProductInterface;
use App\Models\Product;
use App\Traits\Datatables\ProductDatatable;
use Exception;

class ProductRepository extends BaseRepository implements ProductInterface
{
    use ProductDatatable;

    public function __construct(Product $product)
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

    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->ProductMockup($this->model->query());
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        // TODO: Implement show() method.
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
        // TODO: Implement update() method.
    }
}

<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ArchiveProductInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\Product;
use App\Traits\Datatables\ArchiveProductDatatable;
use Exception;

class ArchiveProductRepository extends BaseRepository implements ArchiveProductInterface
{
    use ArchiveProductDatatable;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */

    public function get(): mixed
    {
        return $this->ArchiveProductMockup($this->model->query()
            ->with('category')
            ->withCount('licenses')
            ->oldest('licenses_count')
            ->onlyTrashed());
    }

    /**
     * Handle restore data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function restore(mixed $id): mixed
    {
        return $this->model->query()
            ->onlyTrashed()
            ->find($id)
            ->restore();
    }
}

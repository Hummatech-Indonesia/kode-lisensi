<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\LicenseInterface;
use App\Models\License;
use App\Traits\Datatables\LicenseDatatable;
use Exception;

class LicenseRepository extends BaseRepository implements LicenseInterface
{
    use LicenseDatatable;

    public function __construct(License $license)
    {
        $this->model = $license;
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

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     * @throws Exception
     */

    public function show(mixed $id): mixed
    {
        return $this->LicenseMockup($this->model->query()
            ->where('product_id', $id)
            ->orderBy('is_purchased')
            ->latest());
    }
}

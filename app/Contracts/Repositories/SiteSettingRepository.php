<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\SiteSettingInterface;
use App\Models\SiteSetting;
use App\Traits\Datatables\ProductDatatable;
use Exception;

class SiteSettingRepository extends BaseRepository implements SiteSettingInterface
{
    use ProductDatatable;

    public function __construct(SiteSetting $setting)
    {
        $this->model = $setting;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->first();
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

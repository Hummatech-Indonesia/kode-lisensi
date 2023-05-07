<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\BannerInterface;
use App\Models\Banner;

class BannerRepository extends BaseRepository implements BannerInterface
{
    public function __construct(Banner $banner)
    {
        $this->model = $banner;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->firstOrFail();
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

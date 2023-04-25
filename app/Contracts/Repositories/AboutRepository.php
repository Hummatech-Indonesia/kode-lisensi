<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AboutInterface;
use App\Models\About;

class AboutRepository extends BaseRepository implements AboutInterface
{
    public function __construct(About $about)
    {
        $this->model = $about;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
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

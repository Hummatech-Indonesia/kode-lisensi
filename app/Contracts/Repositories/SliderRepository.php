<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\SliderInterface;
use App\Models\Slider;

class SliderRepository extends BaseRepository implements SliderInterface
{
    public function __construct(Slider $slider)
    {
        $this->model = $slider;
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

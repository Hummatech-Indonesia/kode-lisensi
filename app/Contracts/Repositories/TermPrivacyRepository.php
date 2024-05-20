<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TermInterface;
use App\Contracts\Interfaces\TermPrivacyInterface;
use App\Models\TermPrivacy;

class TermPrivacyRepository extends BaseRepository implements TermPrivacyInterface
{

    public function __construct(TermPrivacy $termPrivacy)
    {
        $this->model = $termPrivacy;
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
        return $this->model->show($id)->update($data);
    }
    /**
     * Method show
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function show(mixed $id):mixed{
        return $this->model->query()->findOrFail($id);
    }
}

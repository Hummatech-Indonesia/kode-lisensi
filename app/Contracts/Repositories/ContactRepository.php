<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ContactInterface;
use App\Models\Contact;

class ContactRepository extends BaseRepository implements ContactInterface
{
    public function __construct(Contact $contact)
    {
        $this->model = $contact;
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
            ->forceDelete();
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->get();
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
}

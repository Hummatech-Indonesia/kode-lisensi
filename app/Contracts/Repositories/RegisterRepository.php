<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\RegisterInterface;
use App\Models\User;

class RegisterRepository extends BaseRepository implements RegisterInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;
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

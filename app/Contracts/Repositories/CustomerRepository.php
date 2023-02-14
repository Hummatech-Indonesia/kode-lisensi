<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\CustomerInterface;
use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Traits\Datatables\CustomerDatatable;
use Exception;

class CustomerRepository extends BaseRepository implements CustomerInterface
{
    use CustomerDatatable;

    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */

    public function get(): mixed
    {
        return $this->CustomerMockup($this->model->query()
            ->role(UserRoleEnum::CUSTOMER->value)
            ->latest());
    }
}

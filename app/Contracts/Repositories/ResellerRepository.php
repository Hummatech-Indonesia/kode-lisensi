<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ResellerInterface;
use App\Enums\UserRoleEnum;
use App\Models\User;
use App\Traits\Datatables\ResellerDatatable;
use Exception;

class ResellerRepository extends BaseRepository implements ResellerInterface
{
    use ResellerDatatable;

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
        return $this->ResellerMockup($this->model->query()
            ->withCount('transactions')
            ->withSum('transactions', 'paid_amount')
            ->role(UserRoleEnum::RESELLER->value)
            ->orderByDesc('transactions_count')
            ->latest());
    }
}

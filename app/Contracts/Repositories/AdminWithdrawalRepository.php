<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\AdminWithdrawalInterface;
use App\Models\BalanceWithdrawal;
use App\Traits\Datatables\BalanceWithdrawalDatatable;

class AdminWithdrawalRepository extends BaseRepository implements AdminWithdrawalInterface
{
    use BalanceWithdrawalDatatable;

    public function __construct(BalanceWithdrawal $balanceWithdrawal)
    {
        $this->model = $balanceWithdrawal;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->BalanceWithdrawalMockup(
            $this->model->query()->get()
        );
    }
}

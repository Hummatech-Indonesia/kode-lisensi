<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Models\BalanceWithdrawal;
use App\Models\PinRekening;

class BalanceWithdrawalRepository extends BaseRepository implements BalanceWithdrawalInterface
{

    public function __construct(BalanceWithdrawal $balanceWithdrawal)
    {
        $this->model = $balanceWithdrawal;
    }
    /**
     * store
     *
     * @param  mixed $data
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->create($data);
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)
            ->get();
    }
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\BalanceWithdrawalInterface;
use App\Models\BalanceWithdrawal;
use App\Models\PinRekening;
use App\Traits\Datatables\BalanceWithdrawalDatatable;
use App\Traits\Datatables\ProductDatatable;
use Illuminate\Http\Request;

class BalanceWithdrawalRepository extends BaseRepository implements BalanceWithdrawalInterface
{
    use BalanceWithdrawalDatatable;

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
     * search
     *
     * @param  mixed $request
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->BalanceWithdrawalMockup(
            $this->model->query()
        );
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->BalanceWithdrawalMockup(
            $this->model->query()
                ->where('user_id', auth()->user()->id)
        );
    }
    public function getHistory(): mixed
    {
        return $this->BalanceWithdrawalMockup(
            $this->model->query()->with('user')->where('status',1)
        );
    }
}

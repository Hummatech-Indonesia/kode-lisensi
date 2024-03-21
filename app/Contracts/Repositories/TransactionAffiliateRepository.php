<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Models\TransactionAffiliate;
use App\Traits\Datatables\TransactionAffiliateDatatable;

class TransactionAffiliateRepository extends BaseRepository implements TransactionAffiliateInterface
{
    use TransactionAffiliateDatatable;

    public function __construct(TransactionAffiliate $transactionAffiliate)
    {
        $this->model = $transactionAffiliate;
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
        return $this->TransactionAffiliateMockup(
            $this->model->query()
                ->with('transaction.detail_transaction')
                ->where('code_affiliate', auth()->user()->code_affiliate)
        );
    }
}

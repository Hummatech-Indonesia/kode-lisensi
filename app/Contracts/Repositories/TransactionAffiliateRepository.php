<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Models\TransactionAffiliate;

class TransactionAffiliateRepository extends BaseRepository implements TransactionAffiliateInterface
{
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
}

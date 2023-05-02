<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TransactionInterface;
use App\Enums\LicenseStatusEnum;
use App\Models\Transaction;
use App\Traits\Datatables\TransactionDatatable;
use Exception;

class TransactionRepository extends BaseRepository implements TransactionInterface
{
    use TransactionDatatable;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->TransactionMockup($this->model->query()
            ->where('license_status', LicenseStatusEnum::PROCESSED->value)
            ->with(['user', 'detail_transaction.product'])
            ->oldest());
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->where('invoice_id', $id)
            ->with(['license.product', 'detail_transaction'])
            ->firstOrFail();
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
            ->create([
                'id' => $data['id'],
                'invoice_id' => $data['external_id'],
                'user_id' => auth()->id(),
                'fee_amount' => $data['fees'][0]['value'],
                'amount' => $data['amount'],
                'invoice_url' => $data['invoice_url'],
                'expiry_date' => now()->addMinutes(30),
                'license_id' => $data['license_id'] ?? null
            ]);
    }
}

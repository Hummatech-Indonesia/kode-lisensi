<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\TransactionInterface;
use App\Models\Transaction;

class TransactionRepository extends BaseRepository implements TransactionInterface
{
    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */
    public function get(): mixed
    {
        // TODO: Implement get() method.
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
            ->with('license.product')
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

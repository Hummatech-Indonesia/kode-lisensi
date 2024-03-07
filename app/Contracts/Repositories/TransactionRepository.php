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
            ->whereIn('license_status', [LicenseStatusEnum::PROCESSED->value])
            ->whereHas('detail_transaction.product')
            ->with(['user', 'detail_transaction.product'])
            ->oldest());
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     */

    public function getAll(): mixed
    {
        return $this->TransactionMockup($this->model->query()
            ->whereIn('license_status', [LicenseStatusEnum::COMPLETED->value])
            ->whereHas('detail_transaction.product')
            ->with(['user', 'detail_transaction.product'])
            ->oldest());
    }

    /**
     * apiGet
     *
     * @return mixed
     */
    public function apiGetHistory(): mixed
    {
        return $this->model->query()
            ->whereIn('license_status', [LicenseStatusEnum::COMPLETED->value])
            ->whereHas('detail_transaction.product')
            ->with(['user', 'detail_transaction.product'])
            ->oldest()
            ->get();
    }
    /**
     * apiGetPreorder
     *
     * @return mixed
     */
    public function apiGetPreorder(): mixed
    {
        return $this->model->query()
            ->whereIn('license_status', [LicenseStatusEnum::PROCESSED->value])
            ->whereHas('detail_transaction.product')
            ->with(['user', 'detail_transaction.product'])
            ->oldest()
            ->get();
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
            ->with(['license.product', 'detail_transaction.product', 'detail_transaction.varianProduct'])
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
                'invoice_id' => $data['invoice_id'],
                'user_id' => auth()->id(),
                'fee_amount' => $data['fee_amount'],
                'amount' => $data['amount'],
                'expiry_date' => now()->addMinutes(30),
                'payment_channel' => $data['payment_channel'],
                'payment_method' => $data['payment_method'],
                'invoice_url' => $data['invoice_url'],
                'license_id' => $data['license_id'] ?? null
            ]);
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getInvoice(): mixed
    {
        return $this->model->query()
            ->where('invoice_id', 'LIKE', '%' . "KLHM" . '%')
            ->orderByDesc('created_at')
            ->first();
    }
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\UpdateIdInvoiceInterface;
use App\Contracts\Interfaces\VarianProductInterface;
use App\Models\UpdateInvoice;
use App\Models\VarianProduct;

class UpdateIdInvoiceRepository extends BaseRepository implements UpdateIdInvoiceInterface
{
    public function __construct(UpdateInvoice $updateIdInvoice)
    {
        $this->model = $updateIdInvoice;
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

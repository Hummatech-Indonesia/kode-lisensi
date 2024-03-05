<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ProductEmailInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\ProductEmail;

class ProductEmailRepository extends BaseRepository implements ProductEmailInterface
{
    public function __construct(ProductEmail $productEmail)
    {
        $this->model = $productEmail;
    }
    public function store(array $data): mixed
    {
        return $this->model->query()
            ->updateOrCreate(
                [
                    'product_id'=>$data['product_id']
                ],
                $data
            );
    }
}

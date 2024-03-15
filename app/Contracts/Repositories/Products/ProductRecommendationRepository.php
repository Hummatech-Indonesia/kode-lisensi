<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ProductRecommendationInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Models\ProductRecommendation;
use Exception;

class ProductRecommendationRepository extends BaseRepository implements ProductRecommendationInterface
{

    public function __construct(ProductRecommendation $productRecommendation)
    {
        $this->model = $productRecommendation;
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
            ->updateOrCreate(
                [
                    'product_id' => $data['product_id']
                ],
                $data
            );
    }
}

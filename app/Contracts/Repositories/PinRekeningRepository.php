<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\PinRekeningInterface;
use App\Models\PinRekening;

class PinRekeningRepository extends BaseRepository implements PinRekeningInterface
{

    public function __construct(PinRekening $pinRekening)
    {
        $this->model = $pinRekening;
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
                    'user_id' => $data['user_id']
                ],

                $data
            );
    }
}

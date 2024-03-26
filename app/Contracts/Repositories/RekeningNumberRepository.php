<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ProfileInterface;
use App\Contracts\Interfaces\RekeningNumberInterface;
use App\Models\RekeningNumber;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class RekeningNumberRepository extends BaseRepository implements RekeningNumberInterface
{
    public function __construct(RekeningNumber $rekeningNumber){
        $this->model=$rekeningNumber;
    }
    public function get():mixed{
        return $this->model->query()->get();
    }
    public function store(array $data):mixed{
        return $this->model->query()->create($data);
    }
    public function show(mixed $id):mixed{
        return $this->model->query()->findOrFail($id);
    }
    public function update(mixed $id,array $data):mixed{
        return $this->show($id)->query()->update($data);
    }
    public function delete(mixed $id):mixed{
        return $this->show($id)->query()->delete();
    }
}

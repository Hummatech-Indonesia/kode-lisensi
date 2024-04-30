<?php

namespace App\Contracts\Repositories\Administrator;

use App\Contracts\Interfaces\Administrator\ExpenditureInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Traits\Datatables\ExpenditureDatatable;
use App\Models\Expenditure;

class ExpenditureRepository extends BaseRepository implements ExpenditureInterface
{
    use ExpenditureDatatable;

    public function __construct(Expenditure $expenditure)
    {
        $this->model = $expenditure;
    }
    /**
     * Method get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()->get();
    }
    public function getAll(): mixed
    {
        return $this->ExpenditureMockup($this->model->query()->oldest());
    }
    /**
     * Method store
     *
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function store(array $data): mixed
    {
        return $this->model->query()->create($data);
    }
    /**
     * Method show
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()->findOrFail($id);
    }
    /**
     * Method update
     *
     * @param mixed $id [explicite description]
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        
        return $this->show($id)->update($data);
    }
    /**
     * Method delete
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->show($id)->delete();
    }
}

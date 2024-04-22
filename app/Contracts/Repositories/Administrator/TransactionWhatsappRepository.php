<?php

namespace App\Contracts\Repositories\Administrator;

use App\Contracts\Interfaces\Administrator\TransactionWhatsappInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\ArticleStatusEnum;
use App\Models\Article;
use App\Models\TransactionWhatsapp;
use App\Traits\Datatables\ArticleDatatable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TransactionWhatsappRepository extends BaseRepository implements TransactionWhatsappInterface
{

    public function __construct(TransactionWhatsapp $transactionWhatsapp)
    {
        $this->model = $transactionWhatsapp;
    }

    /**
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->get();
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


    /**
     * show
     *
     * @param  mixed $id
     * @return mixed
     */
    public function show(mixed $id): mixed
    {
        return $this->model->query()
            ->findOrFail($id);
    }
    /**
     * update
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->show($id)->update($data);
    }

    /**
     * delete
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        return $this->model->query()
            ->delete();
    }
}

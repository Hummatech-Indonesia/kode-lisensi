<?php

namespace App\Contracts\Repositories\Administrator;

use App\Contracts\Interfaces\Administrator\RefundInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\StatusRefundEnum;
use App\Models\Refund;
use App\Traits\Datatables\RefundDatatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundRepository extends BaseRepository implements RefundInterface
{
    use RefundDatatable;
    public function __construct(Refund $refund)
    {
        $this->model = $refund;
    }
    /**
     * Method get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->RefundMockup($this->model->query()->where('status', StatusRefundEnum::PENDING->value)->oldest());
    }
    /**
     * Method getAll
     *
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->RefundMockup($this->model->query()->where('user_id', Auth::id())

            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', $request->status);
            })
            ->oldest());
    }
    /**
     * Method get
     *
     * @return mixed
     */
    public function getMyRefund(): mixed
    {
        return $this->RefundMockup($this->model->query()->where('user_id', auth()->user()->id)->oldest());
    }    
    /**
     * Method getRefundHistories
     *
     * @param Request $request [explicite description]
     *
     * @return mixed
     */
    public function getRefundHistories(Request $request): mixed
    {
        return $this->RefundMockup($this->model->query()->whereNot('status', StatusRefundEnum::PENDING->value)->oldest());
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

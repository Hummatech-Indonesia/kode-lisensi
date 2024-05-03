<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\UserInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\UserHelper;
use App\Models\User;
use App\Traits\Datatables\UserDatatable;
use Illuminate\Http\Request;

class UserRepository extends BaseRepository implements UserInterface
{
    use UserDatatable;
    public function __construct(User $user)
    {
        $this->model = $user;
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
     * get
     *
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->get();
    }

    public function userTransaction(): mixed
    {
        return $this->model->query()
            ->whereHas('transactions')
            ->withCount('transactions')
            ->orderByDesc('transactions_count')
            ->take(5)
            ->get();
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
            ->whereNotNull('code_affiliate')
            ->where('code_affiliate', $id)
            ->first();
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getWhere(array $data): mixed
    {
        return $this->UserMockup($this->model->query()
            ->whereNot('email', UserHelper::getUserEmail())
            ->role([UserRoleEnum::ADMIN->value, UserRoleEnum::AUTHOR->value])
            ->latest()
            ->get());
    }

    /**
     * search
     *
     * @param  mixed $request
     * @return mixed
     */
    public function search(Request $request): mixed
    {
        return $this->UserMockup($this->model->query()
            ->whereNot('email', UserHelper::getUserEmail())
            // ->role([UserRoleEnum::ADMIN->value, UserRoleEnum::AUTHOR->value])
            ->when($request->role, function ($query) use ($request) {
                $query->role($request->role);
            })
            ->latest()
            ->get());
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
        return $this->model->query()
            ->findOrFail($id)
            ->update($data);
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
            ->findOrFail($id)
            ->delete();
    }

    /**
     * searchByEmail
     *
     * @return mixed
     */
    public function searchByEmail(mixed $email): mixed
    {
        return $this->model->query()
            ->where('email', $email)
            ->first();
    }
}

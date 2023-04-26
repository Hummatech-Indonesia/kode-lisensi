<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\ProductStatusEnum;
use App\Models\Product;
use App\Traits\Datatables\ProductDatatable;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Pagination\CursorPaginator;

class ProductRepository extends BaseRepository implements ProductInterface
{
    use ProductDatatable;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * Handle the Get all preorder data event from models.
     *
     * @return mixed
     * @throws Exception
     */

    public function preorder(): mixed
    {
        return $this->ProductMockup($this->model->query()
            ->with('category')
            ->oldest()
            ->where('status', ProductStatusEnum::PREORDER->value));
    }

    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->ProductMockup($this->model->query()
            ->with('category')
            ->withCount([
                'licenses as licenses_count' => function ($query) {
                    $query->where('is_purchased', 0);
                }
            ])
            ->oldest('licenses_count')
            ->where('status', ProductStatusEnum::AVAILABLE->value));
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
            ->create($data);
    }

    /**
     * Handle show method and update data instantly from models.
     *
     * @param mixed $id
     * @param array $data
     *
     * @return mixed
     */
    public function update(mixed $id, array $data): mixed
    {
        return $this->show($id)->update($data);
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
            ->findOrFail($id);
    }

    /**
     * Implement soft delete method
     *
     * @param mixed $id
     * @return mixed
     */
    public function softDelete(mixed $id): mixed
    {
        return $this->show($id)->delete($id);
    }

    /**
     * Handle show method and delete data instantly from models.
     *
     * @param mixed $id
     *
     * @return mixed
     */
    public function delete(mixed $id): mixed
    {
        $query = $this->model->query();
        try {
            if ($this->showSoftDelete($id)) {
                $query->onlyTrashed()
                    ->find($id)
                    ->forceDelete();
            } else {
                $query->find($id)
                    ->forceDelete();
            }

        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) return false;
        }

        return true;
    }

    /**
     * Implement show soft delete method
     *
     * @param mixed $id
     * @return mixed
     */
    public function showSoftDelete(mixed $id): mixed
    {
        return $this->model->query()
            ->onlyTrashed()
            ->find($id);
    }

    /**
     * Handle paginate data event from models.
     *
     * @param int $perPage
     * @param array $columns
     * @param string $cursorName
     * @param null $cursor
     * @param Request $request
     * @return CursorPaginator
     */

    public function cursorPaginate(int $perPage = 10, array $columns = ['*'], string $cursorName = 'cursor', $cursor = null, Request $request): CursorPaginator
    {
        return $this->model->query()
            ->when($request->filter, function ($query) use ($request) {
                return $query->whereIn('status', $request->filter);
            })
            ->when($request->categories, function ($query) use ($request) {
                return $query->whereIn('category_id', $request->categories);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->orWhereLike('name', $request->search);
            })
            ->with('category')
            ->withCount([
                'licenses as licenses_count' => function ($query) {
                    $query->where('is_purchased', 0);
                }
            ])
//            ->latest('id')
            ->cursorPaginate($perPage, $columns, $cursorName, $cursor);
    }
}

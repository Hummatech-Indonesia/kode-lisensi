<?php

namespace App\Contracts\Repositories\Products;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Repositories\BaseRepository;
use App\Enums\ProductStatusEnum;
use App\Enums\RatingStatusEnum;
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

    public function showCategory(mixed $id): mixed
    {
        return $this->ProductMockup(
            $this->model->query()
                ->with('category')
                ->where('category_id', $id)
        );
    }

    /**
     * preorder
     *
     * @return mixed
     */
    public function preorder(): mixed
    {
        return $this->ProductMockup($this->model->query()
            ->with('category')
            ->oldest()
            ->where('status', ProductStatusEnum::PREORDER->value));
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
        if (isset($data['name_varian'])) {
            $product = $this->model->query()
                ->create($data);
            for ($i = 0; $i < count($data['name_varian']); $i++) {
                $product->varianProducts()->create([
                    'name' => $data['name_varian'][$i],
                    'sell_price' => $data['sell_price_varian'][$i],
                    'buy_price' => $data['buy_price_varian'][$i],
                ]);
            }
        } else {
            $product = $this->model->query()
                ->create($data);
        }
        return $product;
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
        if (isset($data['name_varian'])) {
            $product = $this->show($id);
            $product->update($data);

            try {
                $product->varianProducts()->delete();
            } catch (Exception $e) {
                return $product;
            }

            for ($i = 0; $i < count($data['name_varian']); $i++) {
                $product->varianProducts()->create([
                    'name' => $data['name_varian'][$i],
                    'sell_price' => $data['sell_price_varian'][$i],
                    'buy_price' => $data['buy_price_varian'][$i],
                ]);
            }
        } else {
            $product = $this->show($id)->update($data);
        }
        return $product;
    }
    /**
     * Method customSlug
     *
     * @param mixed $id [explicite description]
     * @param array $data [explicite description]
     *
     * @return mixed
     */
    public function customSlug(mixed $id, array $data): mixed
    {
        $slug = str_slug($data['slug']);
        $data['slug'] = $slug;

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
            if ($e->errorInfo[1] == 1451)
                return false;
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
            ->when($request->category_id, function ($query) use ($request) {
                return $query->where('category_id', $request->category_id);
            })
            ->when($request->search, function ($query) use ($request) {
                return $query->whereLike('name', $request->search);
            })
            ->when($request->user_id, function ($query) use ($request) {
                $query->whereHas('product_favorites', function ($query) use ($request) {
                    $query->where('user_id', $request->user_id);
                });
            })
            ->with('category')
            ->withCount([
                'licenses as licenses_count' => function ($query) {
                    $query->where('is_purchased', 0);
                }
            ])
            ->withCount('product_ratings')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->latest()
            ->cursorPaginate($perPage, $columns, $cursorName, $cursor);
    }

    /**
     * Handle get the specified data by id from models.
     *
     * @param string $slug
     * @return mixed
     */
    public function showWithSlug(string $slug): mixed
    {
        return $this->model->query()
            ->where('slug', $slug)
            ->with(['category', 'product_questions', 'varianProducts'])
            ->withCount([
                'licenses as licenses_count' => function ($query) {
                    $query->where('is_purchased', 0);
                }
            ])
            ->withCount('product_ratings')
            ->withSum([
                'product_ratings' => function ($query) {
                    $query->where('status', RatingStatusEnum::APPROVED->value);
                }
            ], 'rating')
            ->firstOrFail();
    }

    /**
     * Method getAll
     *
     * @return mixed
     */
    public function getAll(): mixed
    {
        return $this->model->query()
            // ->whereHas('detailTransactions') // Filter hanya produk yang memiliki setidaknya satu detail transaksi terkait
            // ->withCount('detailTransactions') // Menghitung jumlah detail transaksi untuk setiap produk
            // ->orderByDesc('detail_transactions_count') // Mengurutkan berdasarkan jumlah transaksi secara descending
            // ->limit(5)
            ->get();
    }



    /**
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->ProductMockup(
            $this->model->query()
                ->with('category')
                ->withCount([
                    'licenses as licenses_count' => function ($query) {
                        $query->where('is_purchased', 0);
                    }
                ])
                ->where('status', ProductStatusEnum::AVAILABLE->value)
                ->oldest('licenses_count')
        );
    }
    /**
     * Method getProduct
     *
     * @return mixed
     */
    public function getProduct(): mixed
    {
        return $this->model->query()->get();
    }

    /**
     * getProductRecommendation
     *
     * @return mixed
     */
    public function getProductRecommendation(): mixed
    {
        return $this->ProductMockup(
            $this->model->query()
                ->with('category')
                ->whereHas('product_recommendations')
        );
    }

    /**
     * getWhere
     *
     * @param  mixed $data
     * @return mixed
     */
    public function getWhere(array $data): mixed
    {
        return $this->model->query()
            ->where('slug', $data['slug'])
            ->with('varianProducts', function ($query) use ($data) {
                $query->where('slug', $data['slug_varian']);
            })
            ->first();
    }
    /**
     * Handle count all data event from models.
     *
     *
     * @return mixed
     */

    public function search(Request $request): mixed
    {
        return $this->ProductMockup(
            $this->model->query()
                ->with('category')
                ->withCount([
                    'licenses as licenses_count' => function ($query) {
                        $query->where('is_purchased', 0);
                    }
                ])
                ->when($request->status, function ($query) use ($request) {
                    $query->where('status', $request->status);
                })
                ->oldest('licenses_count')
                ->when($request->filter, function ($query) use ($request) {
                    return $query->whereIn('status', $request->filter);
                })
        );
    }
}

<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ArticleInterface;
use App\Enums\ArticleStatusEnum;
use App\Models\Article;
use App\Traits\Datatables\ArticleDatatable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleRepository extends BaseRepository implements ArticleInterface
{
    use ArticleDatatable;

    public function __construct(Article $article)
    {
        $this->model = $article;
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
        return $this->show($id)->delete($id);
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
     * Handle the Get all data event from models.
     *
     * @return mixed
     * @throws Exception
     */
    public function get(): mixed
    {
        return $this->ArticleMockup($this->model->query()
            ->with(['category', 'user']));
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
     * @param string $slug
     * @return mixed
     */
    public function showWithSlug(string $slug): mixed
    {
        return $this->model->query()
            ->where(['slug' => $slug, 'status' => ArticleStatusEnum::PUBLISHED->value])
            ->with(['category', 'user'])
            ->firstOrFail();
    }

    /**
     * Handle paginate data event from models.
     *
     * @param Request $request
     * @param int $pagination
     *
     * @return LengthAwarePaginator
     */
    public function customPaginate(Request $request, int $pagination = 10): LengthAwarePaginator
    {
        return $this->model->query()
            ->where('status', ArticleStatusEnum::PUBLISHED->value)
            ->when($request->category, function ($query) use ($request) {
                return $query->whereRelation('category', 'name', '=', $request->category);
            })
            ->when($request->searchArticle, function ($query) use ($request) {
                return $query->whereLike('title', $request->searchArticle);
            })
            ->with(['category', 'user'])
            ->latest()
            ->paginate($pagination);

    }
}

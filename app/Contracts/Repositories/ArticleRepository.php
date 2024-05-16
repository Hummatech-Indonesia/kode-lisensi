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
     * count
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)
            ->count();
    }

    /**
     * getByUser
     *
     * @return mixed
     */
    public function getByUser(): mixed
    {
        return $this->model->query()
            ->where('user_id', auth()->user()->id)
            ->orderBy('view', 'desc')
            ->get();
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
            ->with(['sub_article_category', 'user']));
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
            ->with(['sub_article_category', 'user'])
            ->firstOrFail();
    }
    /**
     * Method getByTag
     *
     * @param string $tag [explicite description]
     *
     * @return mixed
     */
    public function getByTag(string $tag): mixed
    {
        return $this->model->query()
            ->where('status', ArticleStatusEnum::PUBLISHED->value)
            ->where('tags', 'like', '%' . $tag . '%')
            ->with(['sub_article_category', 'user'])
            ->get();
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
            ->when($request->sub_category, function ($query) use ($request) {
                return $query->whereRelation('sub_article_category', 'name', '=', $request->sub_category);
            })
            ->when($request->searchArticle, function ($query) use ($request) {
                return $query->whereLike('title', $request->searchArticle);
            })
            ->with(['sub_article_category', 'user'])
            ->latest()
            ->paginate($pagination);
    }
}

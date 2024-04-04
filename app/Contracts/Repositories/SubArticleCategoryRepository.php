<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\SubArticleCategoryInterface;
use App\Models\ArticleCategory;
use App\Models\SubArticleCategory;
use Illuminate\Database\QueryException;

class SubArticleCategoryRepository extends BaseRepository implements SubArticleCategoryInterface
{
    public function __construct(SubArticleCategory $subArticleCategory)
    {
        $this->model = $subArticleCategory;
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
    /**
     * Method getCategory
     *
     * @param mixed $id [explicite description]
     *
     * @return mixed
     */
    public function getCategory(mixed $id): mixed
    {
        return $this->model->query()
            ->where('article_category_id', $id)
            ->with('category')
            ->get();
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

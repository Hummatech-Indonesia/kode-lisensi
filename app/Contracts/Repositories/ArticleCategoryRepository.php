<?php

namespace App\Contracts\Repositories;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Models\ArticleCategory;
use Illuminate\Database\QueryException;

class ArticleCategoryRepository extends BaseRepository implements ArticleCategoryInterface
{
    public function __construct(ArticleCategory $article)
    {
        $this->model = $article;
    }

    /**
     * count
     *
     * @return int
     */
    public function count(): int
    {
        return $this->model->query()
            ->count();
    }

    /**
     * getWhereHas
     *
     * @return int
     */
    public function getWhereHas(): mixed
    {
        return $this->model->query()
            ->withCount('articles')
            ->whereHas('articles')
            ->get();
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
        try {
            $this->show($id)->delete($id);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1451) return false;
        }

        return true;
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
     */
    public function get(): mixed
    {
        return $this->model->query()
            ->withCount('articles')
            ->get();
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
}

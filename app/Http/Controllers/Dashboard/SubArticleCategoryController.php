<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\SubArticleCategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Models\SubArticleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SubArticleCategoryController extends Controller
{
    private SubArticleCategoryInterface $subCategory;
    public function __construct(SubArticleCategoryInterface $subCategory)
    {
        $this->subCategory = $subCategory;
    }
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {

    }
    /**
     * Method create
     *
     * @param ArticleCategory $articleCategory [explicite description]
     *
     * @return void
     */
    public function create(ArticleCategory $articleCategory): View
    {
        $articleId = $articleCategory->id;
        $articleName = $articleCategory->name;
        return view('dashboard.pages.article-categories.create-sub', compact('articleId', 'articleName'));
    }

    /**
     * Method store
     *
     * @param SubArticleCategoryRequest $request [explicite description]
     *
     * @return void
     */
    public function store(SubArticleCategoryRequest $request, ArticleCategory $articleCategory): RedirectResponse
    {
        $data = $request->validated();
        $data['article_category_id'] = $articleCategory->id;
        $this->subCategory->store($data);
        return to_route('article-categories.show', $articleCategory->id);
    }

    /**
     * Method edit
     *
     * @param SubArticleCategory $subArticleCategory [explicite description]
     *
     * @return void
     */
    public function edit(ArticleCategory $articleCategory, SubArticleCategory $subArticleCategory): View
    {
        $articleName = $articleCategory->name;
        $articleId = $articleCategory->id;
        return view('dashboard.pages.article-categories.edit-sub', compact('subArticleCategory', 'articleName', 'articleId'));
    }
    /**
     * Method update
     *
     * @param SubArticleCategoryRequest $request [explicite description]
     * @param SubArticleCategory $subArticleCategory [explicite description]
     *
     * @return void
     */
    public function update(SubArticleCategoryRequest $request, ArticleCategory $articleCategory, SubArticleCategory $subArticleCategory): RedirectResponse
    {
        $this->subCategory->update($subArticleCategory->id, $request->validated());
        return to_route('article-categories.show', $articleCategory->id);
    }
    /**
     * Method destroy
     *
     * @param SubArticleCategory $subArticleCategory [explicite description]
     *
     * @return void
     */
    public function destroy(SubArticleCategory $subArticleCategory)
    {
        $this->subCategory->delete($subArticleCategory->id);
        return redirect()->back();
    }
}

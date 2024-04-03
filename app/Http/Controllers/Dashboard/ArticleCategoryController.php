<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\SubArticleCategoryInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleCategoryController extends Controller
{
    private ArticleCategoryInterface $category;
    private SubArticleCategoryInterface $subCategory;

    public function __construct(ArticleCategoryInterface $category,SubArticleCategoryInterface $subCategory)
    {
        $this->category = $category;
        $this->subCategory = $subCategory;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = $this->category->get();

        return view('dashboard.pages.article-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.article-categories.create');
    }
    /**
     * Method show
     *
     * @param ArticleCategory $articleCategory [explicite description]
     *
     * @return View
     */
    public function show(ArticleCategory $articleCategory): View
    {
        $articleName=$articleCategory->name;
        $articleId=$articleCategory->id;
        $subCategories = $this->subCategory->getCategory($articleCategory->id);
        return view('dashboard.pages.article-categories.sub-category', compact('subCategories','articleName','articleId'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ArticleCategory $article_category
     *
     * @return View
     */

    public function edit(ArticleCategory $article_category): View
    {
        return view('dashboard.pages.article-categories.edit', compact('article_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ArticleCategoryRequest $request
     * @param ArticleCategory $article_category
     *
     * @return RedirectResponse
     */
    public function update(ArticleCategoryRequest $request, ArticleCategory $article_category): RedirectResponse
    {
        $this->category->update($article_category->id, $request->validated());

        return to_route('article-categories.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ArticleCategoryRequest $request
     *
     * @return RedirectResponse
     */
    public function store(ArticleCategoryRequest $request): RedirectResponse
    {
        $this->category->store($request->validated());

        return to_route('article-categories.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ArticleCategory $article_category
     *
     * @return RedirectResponse
     */
    public function destroy(ArticleCategory $article_category): RedirectResponse
    {
        if (!$this->category->delete($article_category->id)) {
            return back()->with('error', trans('alert.delete_constrained'));
        }

        return to_route('article-categories.index')->with('success', trans('alert.delete_success'));
    }

}

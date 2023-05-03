<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleCategoryController extends Controller
{
    private ArticleCategoryInterface $category;

    public function __construct(ArticleCategoryInterface $category)
    {
        $this->category = $category;
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
     * Show the form for editing the specified resource.
     *
     * @param ArticleCategory $article_category
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

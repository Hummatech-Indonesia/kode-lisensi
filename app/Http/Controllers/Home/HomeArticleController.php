<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\ArticleInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeArticleController extends Controller
{
    private ArticleInterface $article;
    private ArticleCategoryInterface $category;

    public function __construct(ArticleInterface $article, ArticleCategoryInterface $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
    {
        return view('pages.article', [
            'title' => trans('title.articles'),
            'articles' => $this->article->customPaginate($request),
            'categories' => $this->category->get()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        $article = $this->article->showWithSlug($slug);

        return view('pages.article-detail', [
            'title' => $article->title,
            'description' => $article->description,
            'keywords' => $article->tags,
            'author' => $article->user->name,
            'article' => $article,
            'categories' => $this->category->get()
        ]);
    }
}

<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\ArticleCategoryInterface;
use App\Contracts\Interfaces\ArticleInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeArticleController extends Controller
{
    private ArticleInterface $article;
    private ArticleCategoryInterface $category;
    private ProductInterface $product;

    public function __construct(ArticleInterface $article, ArticleCategoryInterface $category, ProductInterface $product)
    {
        $this->article = $article;
        $this->category = $category;
        $this->product = $product;
    }
    
    /**
     * Method index
     *
     * @param Request $request [explicite description]
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        $products = $this->product->getAll();
        return view('pages.article', [
            'title' => 'Artikel - KodeLisensi.com',
            'products' => $products,
            'articles' => $this->article->customPaginate($request),
            'categories' => $this->category->getWhereHas()
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
        $article->update(['view' => $article->view + 1]);

        return view('pages.article-detail', [
            'title' => 'Artikel-' . $article->slug . ' - KodeLisensi.com',
            'description' => $article->description,
            'keywords' => $article->tags,
            'author' => $article->user->name,
            'article' => $article,
            'categories' => $this->category->get()
        ]);
    }
    public function showTag(Request $request, string $tag): View
    {
        $articles = $this->article->getByTag($tag);
        dd($articles);
        return view('pages.articles-by-tag', [
            'title' => 'Artikel dengan Tag - ' . $tag . ' - KodeLisensi.com',
            'articles' => $articles,
            'tag' => $tag,
            'categories' => $this->category->get()
        ]);
    }


}

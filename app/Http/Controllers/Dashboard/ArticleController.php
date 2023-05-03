<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\ArticleInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ArticleController extends Controller
{
    private ArticleInterface $article;

    public function __construct(ArticleInterface $article)
    {
        $this->article = $article;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */

    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) return $this->article->get();

        return view('dashboard.pages.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

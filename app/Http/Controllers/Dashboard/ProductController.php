<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    private ProductService $service;
    private ProductInterface $product;
    private CategoryInterface $category;

    public function __construct(ProductService $service, ProductInterface $product, CategoryInterface $category)
    {
        $this->service = $service;
        $this->product = $product;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     */

    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->product->get();

        return view('dashboard.pages.products.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $categories = $this->category->get();
        return view('dashboard.pages.products.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        if (!$data = $this->service->store($request)) {
            return back()->with('error', trans('alert.file_exist'));
        }

        $this->product->store($data);

        return to_route('products.index')->with('status', trans('alert.add_success'));
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

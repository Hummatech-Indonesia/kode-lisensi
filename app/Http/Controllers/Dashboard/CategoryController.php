<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Enums\UploadDiskEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private CategoryInterface $category;
    private ProductInterface $product;

    public function __construct(CategoryService $categoryService, CategoryInterface $category, ProductInterface $product)
    {
        $this->categoryService = $categoryService;
        $this->category = $category;
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $categories = $this->category->get();
        return view('dashboard.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('dashboard.pages.categories.add');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return View
     */
    public function edit(Category $category): View
    {
        return view('dashboard.pages.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category): RedirectResponse
    {
        $data = $request->validated();
        if ($request->hasFile('icon')) {
            $upload = $this->categoryService->validateAndUpload(UploadDiskEnum::CATEGORIES->value, $request->file('icon'), $category->icon);
        }

        $this->category->update($category->id, [
            'name' => $data['name'],
            'icon' => $upload ?? $category->icon
        ]);

        return to_route('categories.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('icon')) {
            $upload = $this->categoryService->upload(UploadDiskEnum::CATEGORIES->value, $request->file('icon'));
        }

        $this->category->store([
            'name' => $data['name'],
            'icon' => $upload ?? null
        ]);

        return to_route('categories.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return RedirectResponse
     */

    public function destroy(Category $category): RedirectResponse
    {
        if (!$this->category->delete($category->id)) {
            return back()->with('error', trans('alert.delete_constrained'));
        }

        $this->categoryService->remove($category->icon);

        return back()->with('success', trans('alert.delete_success'));
    }
    public function show(string $slug, Request $request)
    {
        $category = $this->category->getWhere(['slug' => $slug]);
        if ($request->ajax())
            return $this->product->showCategory($category->id);

        return view('dashboard.pages.categories.product', compact('category'));
    }

    /**
     * getAjax
     *
     * @return void
     */
    public function getAjax()
    {
        $categories = $this->category->get();
        return ResponseHelper::success($categories);
    }
}

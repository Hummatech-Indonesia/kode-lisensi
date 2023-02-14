<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\CategoryInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryService $categoryService;
    private CategoryInterface $category;

    public function __construct(CategoryService $categoryService, CategoryInterface $category)
    {
        $this->categoryService = $categoryService;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.categories.index');
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

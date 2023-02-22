<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\Products\ArchiveProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArchiveProductController extends Controller
{
    private ArchiveProductInterface $archiveProduct;

    public function __construct(ArchiveProductInterface $archiveProduct)
    {
        $this->archiveProduct = $archiveProduct;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return object
     */
    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->archiveProduct->get();

        return view('dashboard.pages.products.archive');
    }

    /**
     * Display a listing of the resource.
     *
     * @param mixed $id
     * @return object
     */
    public function update(mixed $id): object
    {
        $this->archiveProduct->restore($id);
        return back()->with('success', trans('alert.restore_success'));
    }
}

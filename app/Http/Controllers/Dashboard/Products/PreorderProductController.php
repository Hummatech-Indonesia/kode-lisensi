<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PreorderProductController extends Controller
{
    private ProductInterface $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    /**
     * Handle get preorder products
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */

    public function index(Request $request): object
    {
        if ($request->ajax()) return $this->product->preorder();

        return view('dashboard.pages.products.preorder');
    }
}

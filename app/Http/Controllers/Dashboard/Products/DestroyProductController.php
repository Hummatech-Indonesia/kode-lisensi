<?php

namespace App\Http\Controllers\Dashboard\Products;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\RedirectResponse;

class DestroyProductController extends Controller
{
    private ProductInterface $product;
    private ProductService $productService;

    public function __construct(ProductInterface $product, ProductService $productService)
    {
        $this->product = $product;
        $this->productService = $productService;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param mixed $id
     * @return RedirectResponse
     */
    public function destroy(mixed $id): RedirectResponse
    {
        if (!$show = $this->product->showSoftDelete($id)) {
            $show = $this->product->show($id);
        }

        if (!$this->product->delete($id)) {
            return back()->with('error', trans('alert.delete_constrained'));
        }

        $this->productService->remove($show->photo);
        if ($show->attachment_file) {
            $this->productService->remove($show->attachment_file);
        }

        return back()->with('success', trans('alert.delete_success'));
    }

    /**
     * Remove the specified resource using soft delete from storage.
     *
     * @param Product $product
     * @return RedirectResponse
     */

    public function softDestroy(Product $product): RedirectResponse
    {
        $this->product->softDelete($product->id);

        return back()->with('success', trans('alert.soft_delete_success'));
    }
}

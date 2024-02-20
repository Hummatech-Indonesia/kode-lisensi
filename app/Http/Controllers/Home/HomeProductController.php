<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\ShareProductResellerInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlRequest;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\SummaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Jorenvh\Share\Share;
use Illuminate\Support\Facades\URL;

class HomeProductController extends Controller
{
    private ProductInterface $product;
    private CategoryInterface $category;
    private ProductService $productService;
    private SummaryService $summaryService;
    private ShareProductResellerInterface $shareProductReseller;

    public function __construct(ProductInterface $product, CategoryInterface $category, ProductService $productService, SummaryService $summaryService, ShareProductResellerInterface $shareProductReseller)
    {
        $this->product = $product;
        $this->category = $category;
        $this->productService = $productService;
        $this->summaryService = $summaryService;
        $this->shareProductReseller = $shareProductReseller;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        $service = $this->productService->handleProductFilters($request);

        if ($request->ajax()) {
            $view = view('pages.cursor.infinite-products')->with('products', $service['products'])->render();

            return ResponseHelper::success([
                'html' => $view,
                'nextCursor' => $service['nextCursor']
            ], trans('alert.fetch_success'));
        }

        return view('pages.product', [
            'title' => trans('title.product'),
            'products' => $service['products'],
            'nextCursor' => $service['nextCursor'],
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
        $product = $this->product->showWithSlug($slug);

        if (auth()->user()) {
            $roleReseller = UserHelper::getUserRole() == UserRoleEnum::RESELLER->value;
            $checkUser = $this->shareProductReseller->show($product->id);
        }
        $share = new Share();
        if (auth()->user()) {
            if ($roleReseller) {
                $code = strtolower(str_random(7));
                if ($checkUser) {
                    $code = $checkUser->code;
                }
                $shareButtons = $share->page(URL::to('/products/' . $slug . '/' . $code))
                    ->whatsapp()
                    ->facebook()
                    ->telegram()
                    ->getRawLinks();
            }
        } else {
            $shareButtons = $share->page(URL::to('/products/' . $slug))
                ->whatsapp()
                ->facebook()
                ->telegram()
                ->getRawLinks();
        }
        if (auth()->user()) {
            if ($roleReseller) {
                return view('pages.product-detail', [
                    'checkUser' => $checkUser,
                    'code' => $code,
                    'roleReseller' => $roleReseller,
                    'shareButtons' => $shareButtons,
                    'title' => trans('title.product_detail', ['product' => $product->name]),
                    'product' => $product,
                    'recommendProducts' => $this->summaryService->handleRecommendProducts(),
                    'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
                ]);
            } else {
                return view('pages.product-detail', [
                    'shareButtons' => $shareButtons,
                    'title' => trans('title.product_detail', ['product' => $product->name]),
                    'product' => $product,
                    'recommendProducts' => $this->summaryService->handleRecommendProducts(),
                    'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
                ]);
            }
        } else {
            return view('pages.product-detail', [
                'shareButtons' => $shareButtons,
                'title' => trans('title.product_detail', ['product' => $product->name]),
                'product' => $product,
                'recommendProducts' => $this->summaryService->handleRecommendProducts(),
                'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
            ]);
        }
    }

    /**
     * shareProductReseller
     *
     * @return RedirectResponse
     */
    public function shareProductReseller(Product $product, string $code, UrlRequest $request): RedirectResponse
    {
        $this->shareProductReseller->store([
            'user_id' => auth()->user()->id,
            'product_id' => $product->id,
            'code' => $code
        ]);
        return redirect()->away($request->url);
    }
}

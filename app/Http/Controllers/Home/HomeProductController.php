<?php

namespace App\Http\Controllers\Home;

use App\Contracts\Interfaces\CategoryInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\TransactionAffiliateInterface;
use App\Contracts\Interfaces\UserInterface;
use App\Enums\UserRoleEnum;
use App\Helpers\ResponseHelper;
use App\Helpers\UserHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UrlRequest;
use App\Models\Product;
use App\Models\TransactionAffiliate;
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
    private UserInterface $user;
    private TransactionAffiliateInterface $transactionAffiliate;
    private CategoryInterface $category;
    private ProductService $productService;
    private SummaryService $summaryService;

    public function __construct(ProductInterface $product, CategoryInterface $category, ProductService $productService, SummaryService $summaryService, TransactionAffiliateInterface $transactionAffiliate, UserInterface $user)
    {
        $this->product = $product;
        $this->user = $user;
        $this->transactionAffiliate = $transactionAffiliate;
        $this->category = $category;
        $this->productService = $productService;
        $this->summaryService = $summaryService;
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

    public function show(string $slug, string $code_affiliate = null): View
    {
        if (UserHelper::getUserRole() == UserRoleEnum::RESELLER->value) {
            $code_affiliate = null;
        }

        $product = $this->product->showWithSlug($slug);

        $user = $this->user->show($code_affiliate);
        if (auth()->user()) {
            $roleReseller = UserHelper::getUserRole() == UserRoleEnum::RESELLER->value;
        }
        $share = new Share();
        if (auth()->user()) {
            if ($roleReseller) {
                $code = auth()->user()->code_affiliate;
                $shareButtons = $share->page(URL::to('/products/' . $slug . '/' . $code))
                    ->whatsapp()
                    ->facebook()
                    ->telegram()
                    ->getRawLinks();
            } else {
                $shareButtons = $share->page(URL::to('/products/' . $slug))
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
                    'code' => $code,
                    'roleReseller' => $roleReseller,
                    'shareButtons' => $shareButtons,
                    'title' => trans('title.product_detail', ['product' => $product->name]),
                    'user' => $user,
                    'product' => $product,
                    'recommendProducts' => $this->summaryService->handleRecommendProducts(5, $product),
                    'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
                ]);
            } else {
                return view('pages.product-detail', [
                    'shareButtons' => $shareButtons,
                    'title' => trans('title.product_detail', ['product' => $product->name]),
                    'user' => $user,
                    'product' => $product,
                    'recommendProducts' => $this->summaryService->handleRecommendProducts(5, $product),
                    'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
                ]);
            }
        } else {
            return view('pages.product-detail', [
                'shareButtons' => $shareButtons,
                'title' => trans('title.product_detail', ['product' => $product->name]),
                'user' => $user,
                'product' => $product,
                'recommendProducts' => $this->summaryService->handleRecommendProducts(5, $product),
                'sameCategoryProducts' => $this->summaryService->handleSameCategoryProducts($product->id, $product->category_id)
            ]);
        }
    }
}

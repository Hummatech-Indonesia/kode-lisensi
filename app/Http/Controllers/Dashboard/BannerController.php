<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\BannerInterface;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BannerRequest;
use App\Models\Banner;
use App\Services\BannerService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    private BannerInterface $banner;
    private ProductInterface $product;
    private BannerService $service;

    public function __construct(BannerInterface $banner, ProductInterface $product, BannerService $service)
    {
        $this->banner = $banner;
        $this->product = $product;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('dashboard.pages.banners.index', [
            'data' => $this->banner->get(),
            'products' => $this->product->getAll()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param BannerRequest $request
     * @param Banner $banner
     * @return RedirectResponse
     */
    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $this->banner->update($banner->id, $this->service->update($banner, $request));

        return back()->with('success', trans('alert.update_success'));
    }

}

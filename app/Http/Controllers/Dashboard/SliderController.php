<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SliderController extends Controller
{
    private SliderInterface $slider;
    private ProductInterface $product;
    private SliderService $service;

    public function __construct(SliderInterface $slider, ProductInterface $product, SliderService $service)
    {
        $this->slider = $slider;
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
        return view('dashboard.pages.sliders.index', [
            'data' => $this->slider->get(),
            'products' => $this->product->getAll()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SliderRequest $request
     * @param Slider $slider
     * @return RedirectResponse
     */
    public function update(SliderRequest $request, Slider $slider): RedirectResponse
    {
        $this->slider->update($slider->id, $this->service->update($slider, $request));

        return back()->with('success', trans('alert.update_success'));
    }

}

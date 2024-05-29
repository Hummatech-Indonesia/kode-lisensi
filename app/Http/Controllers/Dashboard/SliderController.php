<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\Products\ProductInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Slider;
use App\Services\SliderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
     * Method index
     *
     * @param Request $request [explicite description]
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->slider->search($request);
        return view('dashboard.pages.sliders.index');
        //     return view('dashboard.pages.sliders.index', [
        //         'data' => $this->slider->get(),
        //         'products' => $this->product->getAll()
        //     ]);
    }
    public function create()
    {

        return view('dashboard.pages.sliders.create', [
            'products' => $this->product->getAll()
        ]);
    }
    /**
     * Method store
     *
     * @param SliderRequest $request [explicite description]
     *
     * @return RedirectResponse
     */
    public function store(SliderRequest $request): RedirectResponse
    {
        $this->slider->store($this->service->store($request));
        return to_route('slider.index')->with('success', 'Berhasil menambah data');
    }
    /**
     * Method edit
     *
     * @param Slider $slider [explicite description]
     *
     * @return View
     */
    public function edit(Slider $slider): View
    {
        $data = $this->slider->show($slider->id);
        $products = $this->product->getAll();
        return view('dashboard.pages.sliders.edit', compact('data', 'products'));
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

        return to_route('slider.index')->with('success', 'Berhasil memperbarui data');
    }    
    /**
     * Method destroy
     *
     * @param Slider $slider [explicite description]
     *
     * @return RedirectResponse
     */
    public function destroy(Slider $slider): RedirectResponse
    {
        $this->slider->delete($slider->id);
        return to_route('slider.index')->with('success', 'Berhasil menghapus data');

    }

}

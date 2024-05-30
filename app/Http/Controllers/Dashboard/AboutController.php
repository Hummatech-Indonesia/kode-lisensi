<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\AboutInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutRequest;
use App\Models\About;
use App\Services\AboutService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AboutController extends Controller
{
    private AboutInterface $about;
    private AboutService $service;

    public function __construct(AboutInterface $about, AboutService $service)
    {
        $this->about = $about;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $about = $this->about->get();
        $title = 'Tentang Kami';
        return view('dashboard.pages.about.index', compact('about', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function homepage(): View
    {
        return view('pages.about', [
            'title' => 'Tentang Kami - KodeLisensi.com',
            'about' => $this->about->get(),
        ]);
    }
    public function store(AboutRequest $request)
    {
        $this->about->store($this->service->store($request));
        return back()->with('success', trans('alert.add_success'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutRequest $request
     * @param About $about_u
     * @return RedirectResponse
     */
    public function update(AboutRequest $request, About $about): RedirectResponse
    {
        $this->about->update($about->id,$this->service->update($about,$request));

        return back()->with('success', trans('alert.update_success'));
    }
}

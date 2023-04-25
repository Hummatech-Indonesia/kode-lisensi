<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\AboutInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AboutRequest;
use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AboutController extends Controller
{
    private AboutInterface $about;

    public function __construct(AboutInterface $about)
    {
        $this->about = $about;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $about = $this->about->get();
        return view('dashboard.pages.about.index', compact('about'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function homepage(): View
    {
        $about = $this->about->get();
        return view('pages.about', compact('about'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AboutRequest $request
     * @param About $about_u
     * @return RedirectResponse
     */
    public function update(AboutRequest $request, About $about_u): RedirectResponse
    {
        $this->about->update($about_u->id, $request->validated());

        return back()->with('success', trans('alert.update_success'));
    }
}

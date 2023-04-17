<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TermInterface;
use App\Http\Requests\Dashboard\TermRequest;
use App\Models\TermPrivacy;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TermController extends Controller
{
    private TermInterface $term;

    public function __construct(TermInterface $term)
    {
        $this->term = $term;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $term = $this->term->get();
        return view('dashboard.pages.terms.index', compact('term'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TermRequest $request
     * @param TermPrivacy $term
     * @return RedirectResponse
     */
    public function update(TermRequest $request, TermPrivacy $term): RedirectResponse
    {
        $this->term->update($term->id, $request->validated());
        return back()->with('success', trans('alert.update_success'));
    }

    /**
     * Render term in Homepage
     *
     * @return View
     */

    public function homepage(): View
    {
        $term = $this->term->get();
        return view('pages.term', compact('term'));
    }

}

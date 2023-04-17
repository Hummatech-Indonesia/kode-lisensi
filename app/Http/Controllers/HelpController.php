<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\HelpInterface;
use App\Http\Requests\Dashboard\HelpRequest;
use App\Models\Help;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HelpController extends Controller
{
    private HelpInterface $help;

    public function __construct(HelpInterface $help)
    {
        $this->help = $help;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $helps = $this->help->get();

        return view('dashboard.pages.faqs.index', compact('helps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */

    public function create(): View
    {
        return view('dashboard.pages.faqs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param HelpRequest $request
     * @return RedirectResponse
     */
    public function store(HelpRequest $request): RedirectResponse
    {
        $this->help->store($request->validated());
        return to_route('faqs.index')->with('success', trans('alert.add_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Help $faq
     * @return View
     */

    public function edit(Help $faq): View
    {
        return view('dashboard.pages.faqs.edit', compact('faq'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HelpRequest $request
     * @param Help $faq
     * @return RedirectResponse
     */
    public function update(HelpRequest $request, Help $faq): RedirectResponse
    {
        $this->help->update($faq->id, $request->validated());
        return to_route('faqs.index')->with('success', trans('alert.update_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Help $faq
     * @return RedirectResponse
     */

    public function destroy(Help $faq): RedirectResponse
    {
        $this->help->delete($faq->id);
        return to_route('faqs.index')->with('success', trans('alert.delete_success'));
    }

    /**
     * Render faq in Homepage
     *
     * @return View
     */

    public function homepage(): View
    {
        $helps = $this->help->get();
        return view('pages.faq', compact('helps'));
    }
}

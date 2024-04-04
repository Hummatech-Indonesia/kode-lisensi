<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\ContactInterface;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactController extends Controller
{
    private ContactInterface $contact;

    public function __construct(ContactInterface $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */

    public function index(): View
    {
        $contacts = $this->contact->get();

        return view('dashboard.pages.contact.index', compact('contacts'));
    }

    /**
     * Display a contact form in homepage.
     *
     * @return View
     */
    public function homepage(): View
    {
        return view('pages.contact', [
            'title' => 'Hubungi Kami - Kodelisensi.com'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactRequest $request
     * @return RedirectResponse
     */

    public function store(ContactRequest $request): RedirectResponse
    {
        $this->contact->store($request->validated());

        return back()->with('success', trans('alert.contact_us_feedback'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     */

    public function forceDelete(): RedirectResponse
    {
        $this->contact->delete(null);

        return back()->with('success', trans('alert.delete_success'));
    }
}

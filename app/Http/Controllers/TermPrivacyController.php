<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TermPrivacyInterface;
use App\Http\Requests\TermPrivacyRequest;
use App\Models\TermPrivacy;
use Illuminate\Http\Request;

class TermPrivacyController extends Controller
{
    private TermPrivacyInterface $termPrivacy;
    public function __construct(TermPrivacyInterface $termPrivacy)
    {
        $this->termPrivacy = $termPrivacy;
    }
    public function index()
    {
        $termPrivacy = $this->termPrivacy->get();
        return view('dashboard.pages.terms.index', compact('termPrivacy'));
    }
    public function update(TermPrivacyRequest $request, TermPrivacy $termPrivacy)
    {
        $this->termPrivacy->update($termPrivacy->id, $request->validated());
        return back()->with('success', 'berhasil melakukan update data');
    }
    public function term()
    {
        return view('pages.term', [
            'term' => $this->termPrivacy->get(),
            'title' => trans('title.term')
        ]);
    }
    public function privacy()
    {
        $privacy = $this->termPrivacy->get();
        return view('pages.privacy', [
            'privacy' => $privacy,
            'title' => trans('title.privacy')
        ]);
    }
}

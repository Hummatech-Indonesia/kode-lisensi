<?php

namespace App\Http\Controllers;

use App\Contracts\Interfaces\TermInterface;
use Illuminate\View\View;

class PrivacyController extends Controller
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
        $privacy = $this->term->get();
        return view('pages.privacy', [
            'privacy' => $privacy,
            'title' => trans('title.privacy')
        ]);
    }
}

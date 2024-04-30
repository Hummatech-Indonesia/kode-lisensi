<?php

namespace App\Http\Controllers\Administrator;

use App\Contracts\Interfaces\Administrator\RefundInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\RefundRequest;
use App\Models\Refund;
use App\Services\RefundService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RefundController extends Controller
{

    private RefundInterface $refund;
    private RefundService $service;
    public function __construct(RefundInterface $refund, RefundService $service)
    {
        $this->refund = $refund;
        $this->service = $service;
    }

    /**
     * index
     *
     * @return View
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax())
            return $this->refund->get();
        return view('dashboard.pages.administrator.refund.index');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(RefundRequest $request): RedirectResponse
    {
        $this->refund->store($this->service->store($request));
        return redirect()->back()->with('success', trans('alert.add_success'));
    }

    /**
     * update
     *
     * @param  mixed $refund
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function update(Refund $refund, RefundRequest $request): RedirectResponse
    {
        $this->refund->update($refund->id, $request->validated);
        return redirect()->back()->with('success', trans('alert.update_success'));
    }

    /**
     * destroy
     *
     * @param  mixed $refund
     * @return RedirectResponse
     */
    public function destroy(Refund $refund): RedirectResponse
    {
        $this->delete($refund->id);
        return redirect()->back()->with('success', trans('alert.delete_success'));
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\LicenseInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LicenseRequest;
use App\Models\License;
use App\Services\LicenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LicenseController extends Controller
{
    private LicenseInterface $license;
    private LicenseService $service;

    public function __construct(LicenseInterface $license, LicenseService $service)
    {
        $this->license = $license;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function index(Request $request): JsonResponse
    {
        if ($request->ajax()) return $this->license->get();

        abort(Response::HTTP_FORBIDDEN);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */

    public function licensesUpdate(Request $request): JsonResponse
    {
        if ($request->ajax()) $this->service->handleUpdateLicenses($request);

        return ResponseHelper::success(null, trans('alert.update_success'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LicenseRequest $request
     * @return JsonResponse
     */
    public function store(LicenseRequest $request): JsonResponse
    {
        if ($request->ajax()) $this->service->handleStoreLicense($request);

        return ResponseHelper::success(null, trans('alert.add_success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param License $license
     * @return JsonResponse
     */

    public function destroy(License $license): JsonResponse
    {
        $this->license->delete($license->id);

        return ResponseHelper::success(null, trans('alert.delete_success'));
    }
}

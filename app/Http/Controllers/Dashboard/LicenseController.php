<?php

namespace App\Http\Controllers\Dashboard;

use App\Contracts\Interfaces\LicenseInterface;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\LicenseRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LicenseController extends Controller
{
    private LicenseInterface $license;

    public function __construct(LicenseInterface $license)
    {
        $this->license = $license;
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

        abort(403);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param LicenseRequest $request
     * @return JsonResponse
     */
    public function store(LicenseRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $store = $this->license->store([
            'product_id' => $request->id,
            'username' => $validated['username'] ?? null,
            'password' => $validated['password'] ?? null,
            'serial_key' => $validated['serial_key'] ?? null
        ]);

        return ResponseHelper::success($store, trans('alert.add_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}

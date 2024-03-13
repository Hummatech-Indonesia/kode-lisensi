<?php

namespace App\Services;

use App\Contracts\Interfaces\LicenseInterface;
use App\Http\Requests\Dashboard\LicenseRequest;
use Illuminate\Http\Request;

class LicenseService
{
    private LicenseInterface $license;

    public function __construct(LicenseInterface $license)
    {
        $this->license = $license;
    }

    /**
     * Handle store license to License Model.
     *
     * @param LicenseRequest $request
     * @return void
     */

    public function handleStoreLicense(LicenseRequest $request): void
    {
        $validated = $request->validated();

        $this->license->store([
            'product_id' => $request->id,
            'description' => $validated['description'] ?? null,
            'username' => $validated['username'] ?? null,
            'password' => $validated['password'] ?? null,
            'serial_key' => $validated['serial_key'] ?? null
        ]);
    }

    /**
     * Handle update license to License Model.
     *
     * @param Request $request
     * @return void
     */

    public function handleUpdateLicenses(Request $request): void
    {
        foreach ($request->licenses as $index => $value) {
            $this->license->update($index, [
                'username' => $value['username'] ?? null,
                'password' => $value['password'] ?? null,
                'serial_key' => $value['serial_key'] ?? null
            ]);
        }
    }
}

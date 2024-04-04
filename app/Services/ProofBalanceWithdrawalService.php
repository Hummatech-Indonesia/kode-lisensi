<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\Products\ProductInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\ProofBalanceWithdrawalRequest;
use App\Traits\UploadTrait;

class ProofBalanceWithdrawalService implements ShouldHandleFileUpload
{
    use UploadTrait;
    /**
     * Handle store data event to models.
     *
     * @param ProductStoreRequest $request
     *
     * @return array|bool
     */
    public function store(ProofBalanceWithdrawalRequest $request): array|bool
    {
        $data = $request->validated();
        $data['proof'] = $this->uploadSlug(UploadDiskEnum::PROOF->value, $request->file('proof'), "proof-balance-kodelisensi-" . now());
        $data['status'] = 1;
        return $data;
    }
}

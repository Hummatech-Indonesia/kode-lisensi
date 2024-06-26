<?php

namespace App\Services;

use App\Base\Interfaces\uploads\CustomUploadValidation;
use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Enums\StatusRefundEnum;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\ApproveRefundRequest;
use App\Http\Requests\Dashboard\Article\StoreRequest;
use App\Http\Requests\Dashboard\Article\UpdateRequest;
use App\Http\Requests\RefundRequest;
use App\Models\Article;
use App\Models\Refund;
use App\Models\Transaction;
use App\Traits\UploadTrait;

class RefundService implements ShouldHandleFileUpload, CustomUploadValidation
{
    use UploadTrait;

    /**
     * Handle custom upload validation.
     *
     * @param string $disk
     * @param object $file
     * @param string|null $old_file
     * @return string
     */
    public function validateAndUpload(string $disk, object $file, string $old_file = null): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->upload($disk, $file);
    }

    /**
     * Handle store data event to models.
     *
     * @param StoreRequest $request
     *
     * @return array|bool
     */
    public function store(RefundRequest $request, Transaction $transaction): array|bool
    {
        $data = $request->validated();
        return [
            'transaction_id' => $transaction->id,
            'status' => StatusRefundEnum::PENDING->value,
            'description' => $data['description'],
            'proof' => $this->upload(UploadDiskEnum::PROOF->value, $request->file('proof')),
            'bank' => $data['bank'],
            'rekening_number' => $data['rekening_number'],
        ];
    }

    /**
     * approve
     *
     * @param  mixed $request
     * @return array
     */
    public function approve(ApproveRefundRequest $request): array|bool
    {
        return [
            'proof_admin' => $this->upload(UploadDiskEnum::PROOF->value, $request->file('proof_admin')),
        ];
    }
}

<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Traits\UploadTrait;

class ProductService implements ShouldHandleFileUpload
{
    use UploadTrait;

    /**
     * Handle store data event to models.
     *
     * @param ProductStoreRequest $request
     *
     * @return array|bool
     */
    public function store(ProductStoreRequest $request): array|bool
    {
        $data = $request->validated();
        $attachment = $request->file('attachment_file');
        $exists = UploadDiskEnum::PRODUCT_ATTACHMENTS->value . "/" . $attachment->getClientOriginalName();

        if ($this->exist($exists)) return false;

        $explode = explode('-', $data['type']);
        $status = $explode[0];
        $type = $explode[1];

        return [
            'category_id' => $data['category_id'],
            'status' => $status,
            'type' => $type,
            'name' => $data['name'],
            'photo' => $this->upload(UploadDiskEnum::PRODUCTS->value, $request->file('photo')),
            'buy_price' => $data['buy_price'],
            'sell_price' => $data['sell_price'],
            'discount' => $data['discount'],
            'reseller_discount' => $data['reseller_discount'],
            'description' => $data['description'],
            'installation' => $data['installation'],
            'attachment_file' => $this->upload(UploadDiskEnum::PRODUCT_ATTACHMENTS->value, $attachment, true)
        ];
    }
}

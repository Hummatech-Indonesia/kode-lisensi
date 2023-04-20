<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\Product\ProductStoreRequest;
use App\Http\Requests\Dashboard\Product\ProductUpdateRequest;
use App\Models\Product;
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

        return [
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'type' => $data['type'],
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

    /**
     * Handle store data event to models.
     *
     * @param Product $product
     * @param ProductUpdateRequest $request
     *
     * @return array|bool
     */

    public function update(Product $product, ProductUpdateRequest $request): array|bool
    {
        $data = $request->validated();

        $old_photo = $product->photo;
        $old_attachment = $product->attachment_file;

        if ($request->hasFile('attachment_file')) {
            $attachment = $request->file('attachment_file');
            $exists = UploadDiskEnum::PRODUCT_ATTACHMENTS->value . "/" . $attachment->getClientOriginalName();
            if ($this->exist($exists)) return false;
            $this->remove($old_attachment);
            $old_attachment = $this->upload(UploadDiskEnum::PRODUCT_ATTACHMENTS->value, $attachment, true);
        }

        if ($request->hasFile('photo')) {
            $this->remove($old_photo);
            $old_photo = $this->upload(UploadDiskEnum::PRODUCTS->value, $request->file('photo'));
        }

        return [
            'category_id' => $data['category_id'],
            'status' => $data['status'],
            'type' => $data['type'],
            'name' => $data['name'],
            'photo' => $old_photo,
            'buy_price' => $data['buy_price'],
            'sell_price' => $data['sell_price'],
            'discount' => $data['discount'],
            'reseller_discount' => $data['reseller_discount'],
            'description' => $data['description'],
            'installation' => $data['installation'],
            'attachment_file' => $old_attachment
        ];
    }

    /**
     * Handle count license stock from models.
     *
     * @param Product $product
     * @return array
     */

    public function countStocks(Product $product): array
    {
        return [
            'available' => $this->handleLicenseStocks($product, 0),
            'purchased' => $this->handleLicenseStocks($product, 1)
        ];
    }

    /**
     * Handle count license stock from models.
     *
     * @param Product $product
     * @param int $status
     * @return int
     */

    private function handleLicenseStocks(Product $product, int $status): int
    {
        return $product->licenses()->where('is_purchased', $status)->count();
    }
}

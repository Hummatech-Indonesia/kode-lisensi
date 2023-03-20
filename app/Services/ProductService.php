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
    private Product $product;
    use UploadTrait;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

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
     * @param string $id
     * @param ProductUpdateRequest $request
     *
     * @return array|bool
     */

    public function update(string $id, ProductUpdateRequest $request): array|bool
    {
        $data = $request->validated();
        $old_data = $this->product->query()->findOrFail($id);

        $old_photo = $old_data->photo;
        $old_attachment = $old_data->attachment_file;

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
}

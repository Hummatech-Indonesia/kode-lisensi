<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\BannerInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\BannerRequest;
use App\Models\Banner;
use App\Traits\UploadTrait;

class BannerService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private BannerInterface $banner;

    public function __construct(BannerInterface $banner)
    {
        $this->banner = $banner;
    }

    /**
     * Handle update data event to models.
     *
     * @param Banner $banner
     * @param BannerRequest $request
     *
     * @return array|bool
     */

    public function update(Banner $banner, BannerRequest $request): array|bool
    {
        $data = $request->validated();

        $first_image = $banner->first_image;
        $second_image = $banner->second_image;

        if ($request->hasFile('first_image')) {
            $this->remove($first_image);
            $first_image = $this->uploadSlug(UploadDiskEnum::BANNERS->value, $request->file('first_image'), "banner-kodelisensi-" . now());
        }

        if ($request->hasFile('second_image')) {
            $this->remove($second_image);
            $second_image = $this->uploadSlug(UploadDiskEnum::BANNERS->value, $request->file('second_image'), "banner-kodelisensi-" . now());
        }

        return [
            'first_offer' => $data['first_offer'],
            'first_title' => $data['first_title'],
            'first_description' => $data['first_description'],
            'first_product_url' => $data['first_product_url'],
            'first_image' => $first_image,
            'second_offer' => $data['second_offer'],
            'second_title' => $data['second_title'],
            'second_description' => $data['second_description'],
            'second_product_url' => $data['second_product_url'],
            'second_image' => $second_image
        ];
    }
}

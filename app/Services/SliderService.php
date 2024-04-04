<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\SliderInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\Slider;
use App\Traits\UploadTrait;

class SliderService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private SliderInterface $slider;

    public function __construct(SliderInterface $slider)
    {
        $this->slider = $slider;
    }

    /**
     * Handle store data event to models.
     *
     * @param Slider $slider
     * @param SliderRequest $request
     *
     * @return array|bool
     */

    public function update(Slider $slider, SliderRequest $request): array|bool
    {
        $data = $request->validated();

        $old_photo = $slider->image;

        if ($request->hasFile('image')) {
            $this->remove($old_photo);
            $old_photo = $this->uploadSlug(UploadDiskEnum::SLIDERS->value, $request->file('image'), "slider-kodelisensi-" . now());
        }

        return [
            'offer' => $data['offer'],
            'header' => $data['header'],
            'sub_header' => $data['sub_header'],
            'description' => $data['description'],
            'image' => $old_photo,
            'product_url' => $data['product_url']
        ];
    }
}

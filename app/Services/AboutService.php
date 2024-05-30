<?php

namespace App\Services;

use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Contracts\Interfaces\AboutInterface;
use App\Contracts\Interfaces\SliderInterface;
use App\Enums\UploadDiskEnum;
use App\Http\Requests\Dashboard\AboutRequest;
use App\Http\Requests\Dashboard\SliderRequest;
use App\Models\About;
use App\Models\Slider;
use App\Traits\UploadTrait;

class AboutService implements ShouldHandleFileUpload
{
    use UploadTrait;

    private AboutInterface $about;

    public function __construct(AboutInterface $about)
    {
        $this->about = $about;
    }

    public function store(AboutRequest $request): array|bool
    {
        $data = $request->validated();

        // Handle file uploads
        $image1 = null;
        $image2 = null;

        if ($request->hasFile('image_1')) {
            $image1 = $this->uploadSlug(UploadDiskEnum::ABOUT->value, $request->file('image_1'), "about-kodelisensi-1-" . now());
        }

        if ($request->hasFile('image_2')) {
            $image2 = $this->uploadSlug(UploadDiskEnum::ABOUT->value, $request->file('image_2'), "about-kodelisensi-2-" . now());
        }

        return [
            'image_1' => $image1,
            'image_2' => $image2,
            'title' => $data['title'],
            'content' => $data['content'],
        ];
    }

    public function update(About $about, AboutRequest $request): array|bool
    {
        // Validasi input
        $data = $request->validated();

        // Handle file uploads
        $image1 = null;
        $image2 = null;

        if ($request->hasFile('image_1')) {
            // Mengunggah file baru dengan nama yang unik
            $image1 = $this->uploadSlug(
                UploadDiskEnum::ABOUT->value,
                $request->file('image_1'),
                "about-kodelisensi-1-" . uniqid() . "-" . now()->timestamp
            );
        }

        if ($request->hasFile('image_2')) {
            // Mengunggah file baru dengan nama yang unik
            $image2 = $this->uploadSlug(
                UploadDiskEnum::ABOUT->value,
                $request->file('image_2'),
                "about-kodelisensi-2-" . uniqid() . "-" . now()->timestamp
            );
        }

        // Mengembalikan data yang diupdate
        return [
            'image_1' => $image1,
            'image_2' => $image2,
            'title' => $data['title'],
            'content' => $data['content'],
        ];
    }

}

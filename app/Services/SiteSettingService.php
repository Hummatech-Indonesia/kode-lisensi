<?php

namespace App\Services;

use App\Base\Interfaces\uploads\CustomUploadValidation;
use App\Base\Interfaces\uploads\ShouldHandleFileUpload;
use App\Traits\UploadTrait;

class SiteSettingService implements ShouldHandleFileUpload
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
    public function validateAndUpload(string $disk, object $file, string $old_file = null, string $slug): string
    {
        if ($old_file) $this->remove($old_file);

        return $this->uploadSlug($disk, $file, $slug);
    }
}

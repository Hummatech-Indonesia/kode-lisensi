<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{

    /**
     * Handle upload file to gcs
     * @param string $disk_name
     * @param object $uploaded_file
     * @return string
     */

    public function handleFileUpload(string $disk_name, object $uploaded_file): string
    {
        return Storage::disk('gcs')->put($disk_name, $uploaded_file);
    }

    /**
     * delete specified file in google cloud storage
     * @param string $filename
     * @return void
     */

    public function handleFileDelete(string $filename): void
    {
        if (self::checkIfExist($filename)) Storage::disk('gcs')->delete($filename);
    }

    /**
     * Check if file is already exist in cloud storage
     * @param string $filename
     * @return bool
     */

    public function checkIfExist(string $filename): bool
    {
        return Storage::disk('gcs')->exists($filename);
    }

    /**
     * Get Realpath or access path from specified file stored in gcs
     * @param string $filename
     * @return string
     */

    public function getRealPath(string $filename): string
    {
        return Storage::disk('gcs')->url($filename);
    }
}

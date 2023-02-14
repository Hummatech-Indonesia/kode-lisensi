<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    /**
     * delete specified file in storage
     * @param string $file
     * @return void
     */

    public function remove(string $file): void
    {
        if (Storage::exists($file)) Storage::delete($file);
    }

    /**
     * Handle upload file to storage
     * @param string $disk
     * @param object $file
     * @return string
     */

    public function upload(string $disk, object $file): string
    {
        if (!Storage::exists($disk)) Storage::makeDirectory($disk);

        return Storage::put($disk, $file);
    }
}

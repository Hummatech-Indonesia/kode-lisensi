<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    /**
     * check specified file in storage
     * @param string $file
     * @return bool
     */

    public function exist(string $file): bool
    {
        return Storage::exists($file);
    }

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
     * @param UploadedFile $file
     * @param bool $originalName
     * @return string
     */

    public function upload(string $disk, UploadedFile $file, bool $originalName = false): string
    {
        if (!Storage::exists($disk)) Storage::makeDirectory($disk);

        if ($originalName) {
            return $file->storeAs($disk, $file->getClientOriginalName());
        }

        return Storage::put($disk, $file);
    }
}

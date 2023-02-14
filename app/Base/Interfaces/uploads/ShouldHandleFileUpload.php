<?php

namespace App\Base\Interfaces\uploads;

interface ShouldHandleFileUpload
{
    /**
     * Handle class should implement file upload.
     *
     * @param string $disk
     * @param object $file
     * @return string
     */

    public function upload(string $disk, object $file): string;

    /**
     * Handle class should implement file delete.
     *
     * @param string $file
     * @return void
     */

    public function remove(string $file): void;
}

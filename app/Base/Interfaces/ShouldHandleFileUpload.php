<?php

namespace App\Base\Interfaces;

interface ShouldHandleFileUpload
{
    /**
     * Handle class should implement file upload.
     *
     * @param string $diskName
     * @param object $file
     * @return void
     */

    public function upload(string $diskName, object $file): void;

    /**
     * Handle class should implement file delete.
     *
     * @param string $diskName
     * @return void
     */

    public function remove(string $diskName): void;
}

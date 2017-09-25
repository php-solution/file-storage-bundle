<?php

namespace PhpSolution\FileStorageBundle\Lib\File;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * UploadedFileInterface
 */
interface UploadedFileInterface
{
    /**
     * @return UploadedFile|null
     */
    public function getFile():? UploadedFile;

    /**
     * @param UploadedFile $file
     *
     * @return self
     */
    public function setFile(UploadedFile $file = null);

    /**
     * @return bool
     */
    public function isUploaded(): bool;
}
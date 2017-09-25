<?php

namespace PhpSolution\FileStorageBundle\Event;

use PhpSolution\FileStorageBundle\Lib\File\FileInfoInterface;
use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use PhpSolution\FileStorageBundle\Lib\File\UploadedFileInterface;

/**
 * UploadFileEvent
 */
class UploadFileEvent extends StorageInfoEvent
{
    /**
     * @return StorageInfoInterface|FileInfoInterface|UploadedFileInterface
     */
    public function getStorageInfo(): StorageInfoInterface
    {
        return $this->storageInfo;
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return self
     */
    public function setStorageInfo(StorageInfoInterface $storageInfo)
    {
        if (!$this->isUploadedFile($storageInfo)) {
            throw new \InvalidArgumentException();
        }

        return parent::setStorageInfo($storageInfo);
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return bool
     */
    public function isUploadedFile(StorageInfoInterface $storageInfo): bool
    {
        return $storageInfo instanceof FileInfoInterface &&
            $storageInfo instanceof UploadedFileInterface &&
            $storageInfo->isUploaded();
    }
}
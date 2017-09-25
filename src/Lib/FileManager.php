<?php

namespace PhpSolution\FileStorageBundle\Lib;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use PhpSolution\FileStorageBundle\Lib\Storage\StorageInterface;

/**
 * FileManager
 */
class FileManager
{
    /**
     * @var StorageProvider
     */
    private $storageProvider;

    /**
     * @param StorageProvider $storageProvider
     */
    public function __construct(StorageProvider $storageProvider)
    {
        $this->storageProvider = $storageProvider;
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return StorageInterface
     */
    public function getFileInfoStorage(StorageInfoInterface $storageInfo)
    {
        return $this->storageProvider->getStorageByName($storageInfo->getStorage());
    }

    /**
     * @param \SplFileInfo         $uploadedFile
     * @param StorageInfoInterface $storageInfo
     *
     * @return bool
     */
    public function upload(\SplFileInfo $uploadedFile, StorageInfoInterface $storageInfo): bool
    {
        return $this->getFileInfoStorage($storageInfo)->writeFromFile($uploadedFile, $storageInfo);
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return string
     */
    public function download(StorageInfoInterface $storageInfo): string
    {
        return $this->getFileInfoStorage($storageInfo)->read($storageInfo);
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return \SplFileObject
     */
    public function getFileObject(StorageInfoInterface $storageInfo): \SplFileObject
    {
        return $this->getFileInfoStorage($storageInfo)->getFileObject($storageInfo);
    }

    /**
     * @param StorageInfoInterface $from
     * @param StorageInfoInterface $to
     *
     * @return bool
     */
    public function copy(StorageInfoInterface $from, StorageInfoInterface $to)
    {
        return $this->getFileInfoStorage($to)->write($this->download($from), $to);
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function remove(StorageInfoInterface $storageInfo)
    {
        $this->getFileInfoStorage($storageInfo)->remove($storageInfo);
    }
}
<?php

namespace PhpSolution\FileStorageBundle\Lib;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;

/**
 * FileProvider
 */
class FileProvider
{
    /**
     * @var string
     */
    private $webPath;

    /**
     * @param string $webPath
     */
    public function __construct(string $webPath)
    {
        $this->webPath = $webPath;
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return string
     */
    public function getWebPath(StorageInfoInterface $storageInfo)
    {
        return $this->webPath . str_replace(
                $storageInfo::SEPARATOR,
                '/',
                $storageInfo->getStorageBucket() . $storageInfo::SEPARATOR . $storageInfo->getStoragePath()
            );
    }
}
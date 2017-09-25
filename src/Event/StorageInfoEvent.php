<?php

namespace PhpSolution\FileStorageBundle\Event;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * StorageInfoEvent
 */
class StorageInfoEvent extends Event
{
    /**
     * @var StorageInfoInterface
     */
    protected $storageInfo;

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function __construct(StorageInfoInterface $storageInfo)
    {
        $this->setStorageInfo($storageInfo);
    }

    /**
     * @return StorageInfoInterface
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
        $this->storageInfo = $storageInfo;

        return $this;
    }
}
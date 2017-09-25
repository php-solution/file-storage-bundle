<?php

namespace PhpSolution\FileStorageBundle\Lib;

use PhpSolution\FileStorageBundle\Event\FileEvents;
use PhpSolution\FileStorageBundle\Event\StorageInfoEvent;
use PhpSolution\FileStorageBundle\Event\UploadFileEvent;
use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Processor
 */
class Processor
{
    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function preStore(StorageInfoInterface $storageInfo)
    {
        $this->eventDispatcher->dispatch(FileEvents::ON_SET_STORAGE_INFO, new StorageInfoEvent($storageInfo));
        try {
            // Works only for uploaded files
            $this->eventDispatcher->dispatch(FileEvents::PRE_UPLOAD, new UploadFileEvent($storageInfo));
        } catch (\InvalidArgumentException $ex) {
        }
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function storeUploadedFile(StorageInfoInterface $storageInfo)
    {
        try {
            // Works only for uploaded files
            $event = new UploadFileEvent($storageInfo);
            $this->eventDispatcher->dispatch(FileEvents::ON_UPLOAD, $event);
            $this->eventDispatcher->dispatch(FileEvents::POST_UPLOAD, $event);
        } catch (\InvalidArgumentException $ex) {
        }
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function removeStorageInfo(StorageInfoInterface $storageInfo)
    {
        $this->eventDispatcher->dispatch(FileEvents::ON_REMOVE, new StorageInfoEvent($storageInfo));
    }
}
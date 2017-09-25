<?php

namespace PhpSolution\FileStorageBundle\EventSubscriber;

use PhpSolution\FileStorageBundle\Event\FileEvents;
use PhpSolution\FileStorageBundle\Event\StorageInfoEvent;
use PhpSolution\FileStorageBundle\Event\UploadFileEvent;
use PhpSolution\FileStorageBundle\Lib\StorageProvider;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * BasicSubscriber
 */
class BasicSubscriber implements EventSubscriberInterface
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
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FileEvents::ON_SET_STORAGE_INFO => ['onSetStorageInfo', 1024],
            FileEvents::ON_UPLOAD => ['onUpload', 1024],
            FileEvents::ON_REMOVE => ['onRemove', 1024],
        ];
    }

    /**
     * @param StorageInfoEvent $event
     */
    public function onSetStorageInfo(StorageInfoEvent $event)
    {
        $storageInfo = $event->getStorageInfo();
        $storageInfo->setStorage($storageInfo->getStorageAlias());
    }

    /**
     * TODO: revert DB if fails
     *
     * @param UploadFileEvent $event
     */
    public function onUpload(UploadFileEvent $event)
    {
        $storageInfo = $event->getStorageInfo();
        $storage = $this->storageProvider->getStorageByName($storageInfo->getStorage());
        $storage->writeFromFile($storageInfo->getFile(), $storageInfo);
    }

    /**
     * TODO: revert DB if fails
     *
     * @param StorageInfoEvent $event
     */
    public function onRemove(StorageInfoEvent $event)
    {
        $storageInfo = $event->getStorageInfo();
        $storage = $this->storageProvider->getStorageByName($storageInfo->getStorage());
        $storage->remove($storageInfo);
    }
}
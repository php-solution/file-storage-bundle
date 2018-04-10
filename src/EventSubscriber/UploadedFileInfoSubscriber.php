<?php

namespace PhpSolution\FileStorageBundle\EventSubscriber;

use PhpSolution\FileStorageBundle\Event\FileEvents;
use PhpSolution\FileStorageBundle\Event\UploadFileEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener for set uploaded file information
 */
class UploadedFileInfoSubscriber implements EventSubscriberInterface
{
    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            FileEvents::PRE_UPLOAD => ['onSetUploadedFileInfo', 2048],
        ];
    }

    /**
     * @param UploadFileEvent $event
     */
    public function onSetUploadedFileInfo(UploadFileEvent $event)
    {
        $storageInfo = $event->getStorageInfo();
        $file = $storageInfo->getFile();

        $storageInfo->setName(md5($file->getClientOriginalName() . microtime(true)));
        $storageInfo->setMimeType($file->getMimeType());
        $storageInfo->setSize($file->getSize());
        $storageInfo->setExtension($file->getClientOriginalExtension());
    }
}
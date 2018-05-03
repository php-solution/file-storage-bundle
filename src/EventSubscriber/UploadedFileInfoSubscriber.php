<?php

namespace PhpSolution\FileStorageBundle\EventSubscriber;

use PhpSolution\FileStorageBundle\Event\FileEvents;
use PhpSolution\FileStorageBundle\Event\UploadFileEvent;
use PhpSolution\FileStorageBundle\Lib\Storage\FileSystem;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Listener for set uploaded file information
 */
class UploadedFileInfoSubscriber implements EventSubscriberInterface
{
    /**
     * @var FileSystem
     */
    protected $fileSystem;

    public function __construct(FileSystem $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

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

        // remove old file on update
        if ($storageInfo->getName()) {
            $this->fileSystem->remove($storageInfo);
        }

        $storageInfo->setName(md5($file->getClientOriginalName() . microtime(true)));
        $storageInfo->setMimeType($file->getMimeType());
        $storageInfo->setSize($file->getSize());
        $storageInfo->setExtension($file->getClientOriginalExtension());
    }
}
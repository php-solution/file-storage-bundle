<?php

namespace PhpSolution\FileStorageBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;
use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use PhpSolution\FileStorageBundle\Lib\Processor;

/**
 * ORMEntitySubscriber
 */
class ORMEntitySubscriber implements EventSubscriber
{
    /**
     * @var Processor
     */
    private $processor;

    /**
     * @param Processor $processor
     */
    public function __construct(Processor $processor)
    {
        $this->processor = $processor;
    }

    /**
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return [
            Events::prePersist,
            Events::preUpdate,
            Events::postPersist,
            Events::postUpdate,
            Events::preRemove,
        ];
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /* @var StorageInfoInterface $storageInfo */
        if (($storageInfo = $args->getEntity()) instanceof StorageInfoInterface) {
            $this->processor->preStore($storageInfo);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preUpdate(LifecycleEventArgs $args)
    {
        /* @var StorageInfoInterface $storageInfo */
        if (($storageInfo = $args->getEntity()) instanceof StorageInfoInterface) {
            $this->processor->preStore($storageInfo);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postPersist(LifecycleEventArgs $args)
    {
        /* @var StorageInfoInterface $storageInfo */
        if (($storageInfo = $args->getEntity()) instanceof StorageInfoInterface) {
            $this->processor->storeUploadedFile($storageInfo);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(LifecycleEventArgs $args)
    {
        /* @var StorageInfoInterface $storageInfo */
        if (($storageInfo = $args->getEntity()) instanceof StorageInfoInterface) {
            $this->processor->storeUploadedFile($storageInfo);
        }
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function preRemove(LifecycleEventArgs $args)
    {
        /* @var StorageInfoInterface $storageInfo */
        if (($storageInfo = $args->getEntity()) instanceof StorageInfoInterface) {
            $this->processor->removeStorageInfo($storageInfo);
        }
    }
}
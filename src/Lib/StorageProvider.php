<?php

namespace PhpSolution\FileStorageBundle\Lib;

use PhpSolution\FileStorageBundle\Lib\Storage\StorageInterface;

/**
 * StorageProvider
 */
class StorageProvider
{
    /**
     * @var StorageInterface[]
     */
    private $storageList = [];

    /**
     * @param StorageInterface $storage
     *
     * @return self
     */
    public function addStorage(StorageInterface $storage): StorageProvider
    {
        $this->storageList[$storage::getAlias()] = $storage;

        return $this;
    }

    /**
     * @param string $name
     *
     * @return StorageInterface
     * @throws \RuntimeException
     */
    public function getStorageByName(string $name): StorageInterface
    {
        if (!array_key_exists($name, $this->storageList)) {
            throw new \RuntimeException(sprintf('Filestorage "%s" was not found', $name));
        }

        return $this->storageList[$name];
    }
} 
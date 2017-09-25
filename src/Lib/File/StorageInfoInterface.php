<?php

namespace PhpSolution\FileStorageBundle\Lib\File;

/**
 * StorageInfoInterface
 */
interface StorageInfoInterface
{
    const SEPARATOR = '/';

    /**
     * @return string
     */
    public function getStorage(): string;

    /**
     * @param string $storage
     *
     * @return self
     */
    public function setStorage(string $storage);

    /**
     * @return string
     */
    public function getStoragePath(): string;

    /**
     * @return string
     */
    public function getStorageAlias(): string;

    /**
     * @return string
     */
    public function getStorageBucket();
}
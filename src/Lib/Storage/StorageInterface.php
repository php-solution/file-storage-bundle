<?php

namespace PhpSolution\FileStorageBundle\Lib\Storage;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;

/**
 * StorageInterface
 */
interface StorageInterface
{
    /**
     * @return string
     */
    public static function getAlias(): string;

    /**
     * @param string               $content
     * @param StorageInfoInterface $storageInfo
     *
     * @return boolean
     */
    public function write(string $content, StorageInfoInterface $storageInfo): bool;

    /**
     * @param \SplFileInfo         $file
     * @param StorageInfoInterface $storageInfo
     *
     * @return bool
     */
    public function writeFromFile(\SplFileInfo $file, StorageInfoInterface $storageInfo): bool;

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return string
     */
    public function read(StorageInfoInterface $storageInfo): string;

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return mixed
     */
    public function getFileObject(StorageInfoInterface $storageInfo);

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function remove(StorageInfoInterface $storageInfo): void;

    /**
     * @param StorageInfoInterface $from
     * @param StorageInfoInterface $to
     */
    public function copy(StorageInfoInterface $from, StorageInfoInterface $to): void;
} 
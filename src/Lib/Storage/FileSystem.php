<?php

namespace PhpSolution\FileStorageBundle\Lib\Storage;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use Symfony\Component\Filesystem\Filesystem as SymfonyFileSystem;

/**
 * FileSystem
 */
class FileSystem implements StorageInterface
{
    /**
     * @var string
     */
    private $basePath;
    /**
     * @var SymfonyFileSystem
     */
    private $fileSystem;

    /**
     * Changing directory separator to unix way.
     * Add directory separator to the end of path.
     *
     * @param string $basePath
     */
    public function __construct(string $basePath)
    {
        $basePath = str_replace(StorageInfoInterface::SEPARATOR, DIRECTORY_SEPARATOR, $basePath);
        $this->basePath = substr($basePath, -1) !== DIRECTORY_SEPARATOR ? ($basePath . DIRECTORY_SEPARATOR) : $basePath;
        $this->fileSystem = new SymfonyFileSystem();
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return string
     */
    private function getFileRealPath(StorageInfoInterface $storageInfo)
    {
        return $this->basePath . str_replace(
            $storageInfo::SEPARATOR,
            DIRECTORY_SEPARATOR,
            $storageInfo->getStorageBucket() . $storageInfo::SEPARATOR . $storageInfo->getStoragePath()
        );
    }

    /**
     * @return string
     */
    public static function getAlias(): string
    {
        return 'fileSystem';
    }

    /**
     * @param string               $content
     * @param StorageInfoInterface $storageInfo
     *
     * @return bool
     * @throws \RuntimeException
     */
    public function write(string $content, StorageInfoInterface $storageInfo): bool
    {
        $this->createFolders($storageInfo);
        $fileObject = new \SplFileObject($this->getFileRealpath($storageInfo), 'w');
        if ($fileObject->isWritable()) {
            return (bool) $fileObject->fwrite($content);
        }

        throw new \RuntimeException(sprintf('File: "%s" is not writeable', $storageInfo->getStoragePath()));
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    private function createFolders(StorageInfoInterface $storageInfo): void
    {
        $pathParts = pathinfo(str_replace($this->basePath, '', $this->getFileRealpath($storageInfo)));
        $pathIterator = $this->basePath;
        $fileSystem = $this->fileSystem;
        foreach (explode(DIRECTORY_SEPARATOR, $pathParts['dirname']) as $pathName) {
            $pathIterator = $pathIterator . $pathName;
            if (!$fileSystem->exists($pathIterator)) {
                $fileSystem->mkdir($pathIterator, 0755);
            }
            $pathIterator .= DIRECTORY_SEPARATOR;
        }
    }

    /**
     * @param \SplFileInfo         $file
     * @param StorageInfoInterface $storageInfo
     *
     * @return bool
     */
    public function writeFromFile(\SplFileInfo $file, StorageInfoInterface $storageInfo): bool
    {
        return $this->write(file_get_contents($file->getRealPath()), $storageInfo);
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return string
     */
    public function read(StorageInfoInterface $storageInfo): string
    {
        return file_get_contents($this->getFileRealpath($storageInfo));
    }

    /**
     * @param StorageInfoInterface $storageInfo
     *
     * @return \SplFileObject
     */
    public function getFileObject(StorageInfoInterface $storageInfo)
    {
        return new \SplFileObject($this->getFileRealpath($storageInfo));
    }

    /**
     * @param StorageInfoInterface $storageInfo
     */
    public function remove(StorageInfoInterface $storageInfo): void
    {
        $this->fileSystem->remove($this->getFileRealpath($storageInfo));
    }

    /**
     * @param StorageInfoInterface $from
     * @param StorageInfoInterface $to
     */
    public function copy(StorageInfoInterface $from, StorageInfoInterface $to): void
    {
        $this->fileSystem->copy($this->getFileRealpath($from), $this->getFileRealpath($to), true);
    }
}
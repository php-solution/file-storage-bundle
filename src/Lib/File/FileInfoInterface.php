<?php

namespace PhpSolution\FileStorageBundle\Lib\File;

/**
 * FileInfoInterface
 */
interface FileInfoInterface
{
    /**
     * @return string
     */
    public function getName(): ?string;

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name);

    /**
     * @return string
     */
    public function getExtension(): string;

    /**
     * @param string $extension
     *
     * @return self
     */
    public function setExtension(string $extension);

    /**
     * @return string
     */
    public function getMimeType(): string;

    /**
     * @param string $mimeType
     *
     * @return self
     */
    public function setMimeType(string $mimeType);

    /**
     * @return int
     */
    public function getSize(): int;

    /**
     * @param int $size
     *
     * @return self
     */
    public function setSize(int $size);
}
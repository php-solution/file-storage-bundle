<?php

namespace PhpSolution\FileStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FileInfoTrait
 */
trait FileInfoTrait
{
    /**
     * @ORM\Column(name="`name`", type="string", length=255, nullable=true)
     *
     * @var string
     */
    protected $name;
    /**
     * @ORM\Column(name="extension", type="string", length=255, nullable=false)
     *
     * @var string
     */
    protected $extension;
    /**
     * @ORM\Column(name="mime_type", type="string", length=255, nullable=false)
     *
     * @var string
     */
    protected $mimeType;
    /**
     * @ORM\Column(name="size", type="integer", nullable=false, options={"unsigned": true})
     *
     * @var int
     */
    protected $size;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     *
     * @return self
     */
    public function setExtension(string $extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    /**
     * @param string $mimeType
     *
     * @return self
     */
    public function setMimeType(string $mimeType)
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     *
     * @return self
     */
    public function setSize(int $size)
    {
        $this->size = $size;

        return $this;
    }
}
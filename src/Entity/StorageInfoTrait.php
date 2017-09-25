<?php

namespace PhpSolution\FileStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StorageInfoTrait
 */
trait StorageInfoTrait
{
    /**
     * @ORM\Column(name="storage", type="string", length=255, nullable=false)
     *
     * @var string
     */
    protected $storage;
    /**
     * @return string
     */
    abstract public function getStorageAlias(): string ;

    /**
     * @return string
     */
    public function getStorage(): string
    {
        if (is_null($this->storage)) {
            $this->storage = $this->getStorageAlias();
        }

        return $this->storage;
    }

    /**
     * @param string $storage
     *
     * @return self
     */
    public function setStorage(string $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * @return string
     */
    public function getStoragePath(): string
    {
        return $this->getId();
    }
}
<?php

namespace PhpSolution\FileStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpSolution\Doctrine\Entity\CreatedAtTrait;
use PhpSolution\Doctrine\Entity\UpdatedAtTrait;
use PhpSolution\FileStorageBundle\Lib\File\FileInfoInterface;
use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractFile implements FileInfoInterface, StorageInfoInterface
{
    use FileInfoTrait, StorageInfoTrait, CreatedAtTrait, UpdatedAtTrait;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
<?php

namespace PhpSolution\FileStorageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpSolution\FileStorageBundle\Lib\File\UploadedFileInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\MappedSuperclass
 */
abstract class AbstractUploadedFile extends AbstractFile implements UploadedFileInterface
{
    /**
     * @var null|UploadedFile
     */
    protected $file;

    /**
     * @param null|UploadedFile $file
     *
     * @return self
     */
    public function setFile(UploadedFile $file = null)
    {
        // Needs to trigger update event
        if (null !== $this->getCreatedAt()) {
            $this->setUpdatedAtValue();
        }
        $this->file = $file;

        return $this;
    }

    /**
     * @return UploadedFile|null
     */
    public function getFile():? UploadedFile
    {
        return $this->file;
    }

    /**
     * @return bool
     */
    public function isUploaded(): bool
    {
        return $this->file instanceof UploadedFile;
    }
}
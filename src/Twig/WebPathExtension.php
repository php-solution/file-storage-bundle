<?php

namespace PhpSolution\FileStorageBundle\Twig;

use PhpSolution\FileStorageBundle\Lib\File\StorageInfoInterface;
use PhpSolution\FileStorageBundle\Lib\FileProvider;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * WebPathExtension
 */
class WebPathExtension extends AbstractExtension
{
    /**
     * @var FileProvider
     */
    private $fileProvider;

    /**
     * @param FileProvider $fileProvider
     */
    public function __construct(FileProvider $fileProvider)
    {
        $this->fileProvider = $fileProvider;
    }

    /**
     * @return array
     */
    public function getFilters(): array
    {
        return [new TwigFilter('webPath', [$this, 'getWebPath'])];
    }

    /**
     * @param StorageInfoInterface $file
     *
     * @return string
     */
    public function getWebPath(StorageInfoInterface $file): string
    {
        return $this->fileProvider->getWebPath($file);
    }
}
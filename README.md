# Standard Library

## Install
```` bash
$ composer require php-solution/file-storage-bundle
````

## Usage

1. Add bundle to your application

2. Create AbstractFile:

````PHP
<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpSolution\Doctrine\Entity\IdGeneratedTrait;
use PhpSolution\FileStorageBundle\Entity\AbstractUploadedFile;
use PhpSolution\StdLib\FrequentField\Interfaces\IdentifiableInterface;

/**
 * @ORM\Entity()
 * @ORM\Table(name="file")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 */
abstract class AbstractFile extends AbstractUploadedFile implements IdentifiableInterface
{
    use IdGeneratedTrait;
}
````

3. Create CustomFile. And implement getStorageBucket function

````PHP
<?php

namespace AppBundle\Entity;

use AppBundle\Entity\AbstractFile;

/**
 * CustomFile
 */
class CustomFile extends AbstractFile
{
    /**
     * @return string
     */
    public function getStorageBucket(): string
    {
        return 'custom';
    }
}
````
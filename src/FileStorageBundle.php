<?php

namespace PhpSolution\FileStorageBundle;

use PhpSolution\FileStorageBundle\DependencyInjection\Compiler\StorageCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\EventDispatcher\DependencyInjection\RegisterListenersPass;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * FileStorageBundle
 */
class FileStorageBundle extends Bundle
{
    /**
     * @param ContainerBuilder $container
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new StorageCompilerPass());
        $container->addCompilerPass(
            new RegisterListenersPass(
                'event_dispatcher',
                'file_storage.event_listener',
                'file_storage.event_subscriber'
            )
        );
    }
}
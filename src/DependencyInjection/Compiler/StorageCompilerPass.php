<?php

namespace PhpSolution\FileStorageBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * StorageCompilerPass
 */
class StorageCompilerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('file_storage.lib.storage_provider')) {
            return;
        }

        $definition = $container->getDefinition('file_storage.lib.storage_provider');
        $taggedServices = $container->findTaggedServiceIds('file_storage.storage');
        foreach (array_keys($taggedServices) as $id) {
            $definition->addMethodCall('addStorage', [new Reference($id)]);
        }
    }
}
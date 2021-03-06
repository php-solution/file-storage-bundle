<?php

namespace PhpSolution\FileStorageBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * FileStorageExtension
 */
class FileStorageExtension extends Extension
{
    /**
     * @param array            $configs
     * @param ContainerBuilder $container
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        if ($config['orm']['enabled']) {
            $loader->load('doctrine_orm.yml');
        }

        $this->initStorageFileSystem($loader, $config, $container);
    }

    /**
     * @param Loader\YamlFileLoader $loader
     * @param array                 $config
     * @param ContainerBuilder      $container
     */
    private function initStorageFileSystem(Loader\YamlFileLoader $loader, array $config, ContainerBuilder $container)
    {
        $container->setParameter('file_storage.file_system.webpath', $config['file_system']['webpath']);
        $container->setParameter('file_storage.file_system.path', $config['file_system']['path']);
        if (!$config['file_system']['enabled']) {
            $container->getDefinition('file_storage.lib.storage.file_system')->clearTag('file_storage.storage');
        }
    }
}
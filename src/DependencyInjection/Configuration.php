<?php

namespace PhpSolution\FileStorageBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $treeBuilder
            ->root('file_storage')
            ->children()
                ->arrayNode('orm')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultValue(true)->end()
                    ->end()
                ->end()
                ->arrayNode('file_system')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('enabled')->defaultValue(true)->end()
                        ->scalarNode('path')->defaultValue('%kernel.root_dir%/../web/upload/')->end()
                        ->scalarNode('webpath')->defaultValue('/upload/')->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

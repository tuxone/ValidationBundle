<?php

namespace TuxOne\ValidationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('tuxone_validation');
        $rootNode
            ->children()
                ->scalarNode('dictionary_file_path')
                    ->defaultValue(__DIR__.'/../Dictionaries/list.txt')
                ->end()
                ->booleanNode('use_wildcard')
                    ->defaultValue(false)
                ->end()
            ->end();

        return $treeBuilder;
    }
}
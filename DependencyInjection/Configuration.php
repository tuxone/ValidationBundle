<?php

namespace TuxOne\ValidationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode =  $treeBuilder->root('tuxone_validation')->children();
        $rootNode->scalarNode('dictionary_file')->defaultValue(__DIR__."/../Dictionaries/list.txt")->end();
        return $treeBuilder;
    }
}
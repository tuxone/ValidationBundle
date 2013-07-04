<?php

namespace TuxOne\ValidationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

class TuxOneValidationExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        if(isset($config['dictionaryPath'])){
            $container->setParameter(
                'validation_bundle.dictionary_file',
                $config['dictionaryPath']
            );
        }else{
            $container->setParameter(
                'validation_bundle.dictionary_file',
                __DIR__."/../Dictionaries/list.txt"
            );
        }

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');


    }
}
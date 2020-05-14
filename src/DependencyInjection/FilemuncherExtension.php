<?php

namespace StableCube\FileMuncherBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class FilemuncherExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('filemuncher.client_id', $config['client_id']);
        $container->setParameter('filemuncher.client_secret', $config['client_secret']);
        $container->setParameter('filemuncher.workspace_hub_api_root', $config['workspace_hub_api_root']);
        $container->setParameter('filemuncher.token_endpoint', $config['token_endpoint']);
        $container->setParameter('filemuncher.backend_scopes', $config['backend_scopes']);
        $container->setParameter('filemuncher.tmp_cache_dir', $config['tmp_cache_dir']);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
    }
}

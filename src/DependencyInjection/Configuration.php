<?php

namespace StableCube\FileMuncherBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('filemuncher', 'array');
        $rootNode = $treeBuilder->getRootNode();

        $rootNode->children()
            ->scalarNode('client_id')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('client_secret')->isRequired()->cannotBeEmpty()->end()
            ->scalarNode('token_endpoint')->defaultValue('https://id.stablecube.com/connect/token')->cannotBeEmpty()->end()
            
            ->scalarNode('backend_scopes')
                ->defaultValue([
                    'workspace_hub_owner_admin',
                    'workspace_fileserver_owner_admin'
                ])
            ->cannotBeEmpty()->end()

            ->scalarNode('workspace_hub_api_root')->defaultValue('https://api.filemuncher.com/v1/workspace')->cannotBeEmpty()->end()
            ->scalarNode('tmp_cache_dir')->defaultValue('/tmp/filemuncher')->cannotBeEmpty()->end();
            
        return $treeBuilder;
    }
}

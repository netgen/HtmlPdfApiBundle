<?php

namespace Netgen\HtmlPdfApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('netgen_html_pdf_api');

        $rootNode
            ->children()
                ->scalarNode('host')
                    ->defaultValue('htmlpdfapi.com/api/v1/')
                    ->info('The hostname of HTMLPDFAPI server')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('token')
                    ->defaultValue(null)
                    ->info('Authentication token for HTMLPDFAPI')
                    ->cannotBeEmpty()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}

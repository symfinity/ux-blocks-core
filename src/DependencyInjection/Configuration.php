<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('symfinity_ux_blocks_core');
        $root = $treeBuilder->getRootNode();

        $root
            ->children()
                ->booleanNode('fragment_ids')
                    ->info('Emit data-ui-fragment from ux_roles.yaml (Stage B+). Stage A default: false.')
                    ->defaultFalse()
                ->end()
                ->arrayNode('ui_assets')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('always_tiers')
                            ->info('Tiers whose styles every full page gets, e.g. [marketing] when such a block first appears inside a Live re-render.')
                            ->enumPrototype()
                                ->values(['core', 'form', 'extended', 'interactive', 'marketing', 'ecommerce'])
                            ->end()
                            ->defaultValue([])
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}

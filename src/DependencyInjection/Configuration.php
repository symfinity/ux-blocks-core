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
            ->end();

        return $treeBuilder;
    }
}

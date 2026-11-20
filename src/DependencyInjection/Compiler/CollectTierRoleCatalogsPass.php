<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\DependencyInjection\Compiler;

use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Feeds the role registry every installed tier catalogue (`ux_blocks_{tier}.package_dir`), core first.
 */
final class CollectTierRoleCatalogsPass implements CompilerPassInterface
{
    private const PARAMETER_PATTERN = '/^ux_blocks_([a-z]+)\.package_dir$/';

    public function process(ContainerBuilder $container): void
    {
        if (!$container->hasDefinition(UxRoleRegistry::class)) {
            return;
        }

        $paths = [];
        foreach ($container->getParameterBag()->all() as $name => $value) {
            if (preg_match(self::PARAMETER_PATTERN, $name, $matches) !== 1 || !\is_string($value)) {
                continue;
            }

            $resolved = $container->getParameterBag()->resolveValue($value);
            if (!\is_string($resolved)) {
                continue;
            }
            $catalogue = $resolved . '/config/ux_roles.yaml';
            if (!is_file($catalogue)) {
                continue;
            }

            $paths[$matches[1]] = $catalogue;
        }

        if (!isset($paths['core'])) {
            return;
        }

        $core = $paths['core'];
        unset($paths['core']);
        ksort($paths);

        $container->getDefinition(UxRoleRegistry::class)
            ->setArgument('$yamlPaths', [$core, ...array_values($paths)]);
    }
}

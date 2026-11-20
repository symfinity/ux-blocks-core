<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\DependencyInjection\Compiler\CollectTierRoleCatalogsPass;
use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;
use Symfony\Component\DependencyInjection\ContainerBuilder;

final class CollectTierRoleCatalogsPassTest extends TestCase
{
    #[Test]
    public function itPassesEveryInstalledTierCatalogueCoreFirst(): void
    {
        $packages = \dirname(__DIR__, 4);

        $container = new ContainerBuilder();
        $container->setParameter('ux_blocks_extended.package_dir', $packages . '/ux-blocks-extended');
        $container->setParameter('foo.package_dir', $packages . '/ux-blocks-form');
        $container->setParameter('ux_blocks_core.package_dir', $packages . '/ux-blocks-core');
        $container->setParameter('ux_blocks_kiosk.package_dir', $packages . '/ux-blocks-kiosk');
        $container->register(UxRoleRegistry::class, UxRoleRegistry::class)
            ->setArgument('$yamlPaths', ['%ux_blocks_core.package_dir%/config/ux_roles.yaml']);

        (new CollectTierRoleCatalogsPass())->process($container);

        self::assertSame(
            [
                $packages . '/ux-blocks-core/config/ux_roles.yaml',
                $packages . '/ux-blocks-extended/config/ux_roles.yaml',
            ],
            $container->getDefinition(UxRoleRegistry::class)->getArgument('$yamlPaths'),
        );
    }

    #[Test]
    public function itDoesNothingWithoutTheRegistry(): void
    {
        $container = new ContainerBuilder();
        $container->setParameter('ux_blocks_core.package_dir', \dirname(__DIR__, 3));

        (new CollectTierRoleCatalogsPass())->process($container);

        self::assertFalse($container->hasDefinition(UxRoleRegistry::class));
    }
}

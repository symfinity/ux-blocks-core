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
        $root = sys_get_temp_dir() . '/ux-blocks-tiers-' . bin2hex(random_bytes(4));
        $core = $root . '/ux-blocks-core';
        $extended = $root . '/ux-blocks-extended';
        $form = $root . '/ux-blocks-form';
        $kiosk = $root . '/ux-blocks-kiosk';
        foreach ([$core, $extended, $form, $kiosk] as $packageDir) {
            mkdir($packageDir . '/config', 0777, true);
        }
        $catalogue = "ux_role_registry: \"1.4\"\nregistry_prefix: blocks\nroles: []\n";
        file_put_contents($core . '/config/ux_roles.yaml', $catalogue);
        file_put_contents($extended . '/config/ux_roles.yaml', $catalogue);

        try {
            $container = new ContainerBuilder();
            $container->setParameter('ux_blocks_extended.package_dir', $extended);
            $container->setParameter('foo.package_dir', $form);
            $container->setParameter('ux_blocks_core.package_dir', $core);
            $container->setParameter('ux_blocks_kiosk.package_dir', $kiosk);
            $container->register(UxRoleRegistry::class, UxRoleRegistry::class)
                ->setArgument('$yamlPaths', ['%ux_blocks_core.package_dir%/config/ux_roles.yaml']);

            (new CollectTierRoleCatalogsPass())->process($container);

            self::assertSame(
                [
                    $core . '/config/ux_roles.yaml',
                    $extended . '/config/ux_roles.yaml',
                ],
                $container->getDefinition(UxRoleRegistry::class)->getArgument('$yamlPaths'),
            );
        } finally {
            foreach ([$core, $extended] as $packageDir) {
                unlink($packageDir . '/config/ux_roles.yaml');
            }
            foreach ([$core, $extended, $form, $kiosk] as $packageDir) {
                rmdir($packageDir . '/config');
                rmdir($packageDir);
            }
            rmdir($root);
        }
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

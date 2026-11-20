<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;

final class UxRoleRegistryMultiCatalogTest extends TestCase
{
    #[Test]
    public function itFindsComponentsAcrossEveryTierCatalogue(): void
    {
        $packages = \dirname(__DIR__, 4);
        $paths = array_map(
            static fn (string $slug): string => $packages . '/' . $slug . '/config/ux_roles.yaml',
            ['ux-blocks-core', 'ux-blocks-form', 'ux-blocks-extended', 'ux-blocks-interactive', 'ux-blocks-live'],
        );
        foreach ($paths as $path) {
            if (!is_file($path)) {
                self::markTestSkipped('Sibling tier catalogues exist only in the monorepo checkout.');
            }
        }

        $registry = new UxRoleRegistry($paths);

        self::assertSame('blocks.ext.card', $registry->findByTwigComponent('Card')?->fragmentId);
        self::assertStringStartsWith('blocks.live.', (string) $registry->findByTwigComponent('ComboboxLive')?->fragmentId);
        self::assertSame('blocks.button', $registry->findByTwigComponent('Button')?->fragmentId);
        self::assertNull($registry->findCoreByTwigComponent('Card'), 'core-only lookup must ignore tier catalogues');
    }

    #[Test]
    public function itRejectsATwigComponentDeclaredInTwoCatalogues(): void
    {
        $dir = sys_get_temp_dir() . '/ux-roles-duplicate-' . bin2hex(random_bytes(4));
        mkdir($dir);
        file_put_contents($dir . '/a.yaml', <<<'YAML'
ux_role_registry: "1.4"
registry_prefix: blocks.core
roles:
  - role: widget
    twig_component: Widget
YAML);
        file_put_contents($dir . '/b.yaml', <<<'YAML'
ux_role_registry: "1.4"
registry_prefix: blocks.ext
roles:
  - role: widget
    twig_component: Widget
YAML);

        try {
            $this->expectException(\LogicException::class);
            $this->expectExceptionMessageMatches('/Widget.*a\.yaml.*b\.yaml/s');

            new UxRoleRegistry([$dir . '/a.yaml', $dir . '/b.yaml']);
        } finally {
            unlink($dir . '/a.yaml');
            unlink($dir . '/b.yaml');
            rmdir($dir);
        }
    }
}

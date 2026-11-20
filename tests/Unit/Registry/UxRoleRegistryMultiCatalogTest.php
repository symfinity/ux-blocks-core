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
        $registry = new UxRoleRegistry(array_map(
            static fn (string $slug): string => $packages . '/' . $slug . '/config/ux_roles.yaml',
            ['ux-blocks-core', 'ux-blocks-form', 'ux-blocks-extended', 'ux-blocks-interactive', 'ux-blocks-live'],
        ));

        self::assertSame('blocks.ext.card', $registry->findByTwigComponent('Card')?->fragmentId);
        self::assertStringStartsWith('blocks.live.', (string) $registry->findByTwigComponent('ComboboxLive')?->fragmentId);
        self::assertSame('blocks.button', $registry->findByTwigComponent('Button')?->fragmentId);
        self::assertNull($registry->findCoreByTwigComponent('Card'), 'core-only lookup must ignore tier catalogues');
    }

    #[Test]
    public function itRejectsATwigComponentDeclaredInTwoCatalogues(): void
    {
        $dir = \dirname(__DIR__, 2) . '/fixtures/ux_roles_duplicate';

        $this->expectException(\LogicException::class);
        $this->expectExceptionMessageMatches('/Widget.*a\.yaml.*b\.yaml/s');

        new UxRoleRegistry([$dir . '/a.yaml', $dir . '/b.yaml']);
    }
}

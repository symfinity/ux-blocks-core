<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ListContainerQueryTest extends TestCase
{
    private static function listCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/list.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function listRoleDeclaresNamedContainer(): void
    {
        $css = self::listCss();

        self::assertStringContainsString('[data-ui-role="list"]', $css);
        self::assertStringContainsString('container-type: inline-size', $css);
        self::assertStringContainsString('container-name: blocks-list', $css);
    }

    #[Test]
    public function listRoleUsesCompactAndColumnsVariants(): void
    {
        $css = self::listCss();

        self::assertStringContainsString('@container blocks-list (max-width: 22rem)', $css);
        self::assertStringContainsString('[data-ui-part="list-item"]', $css);
        self::assertStringNotContainsString('@container blocks-list (min-width: 48rem)', $css);
        self::assertStringContainsString('[data-ui-variant="columns"]', $css);
        self::assertStringContainsString('[data-ui-part="list-layout"]', $css);
    }

    #[Test]
    public function listRoleStylesItemTitleAndDescriptionParts(): void
    {
        $css = self::listCss();

        self::assertStringContainsString('[data-ui-part="list-item-title"]', $css);
        self::assertStringContainsString('[data-ui-part="list-item-description"]', $css);
        self::assertStringContainsString('flex-direction: column', $css);
        self::assertStringContainsString('border-block-end: 1px solid var(--ui-color-border)', $css);
    }

    #[Test]
    public function listRoleSupportsGapTokens(): void
    {
        $css = self::listCss();

        self::assertStringContainsString('[data-ui-gap="md"]', $css);
        self::assertStringContainsString('[data-ui-variant="columns"]', $css);
        self::assertStringContainsString('grid-template-columns: repeat(2, minmax(0, 1fr))', $css);
    }
}

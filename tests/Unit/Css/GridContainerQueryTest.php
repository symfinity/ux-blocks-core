<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GridContainerQueryTest extends TestCase
{
    private static function gridCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/grid.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function gridRoleDeclaresNamedContainer(): void
    {
        $css = self::gridCss();

        self::assertStringContainsString('[data-ui-role="grid"]', $css);
        self::assertStringContainsString('container-type: inline-size', $css);
        self::assertStringContainsString('container-name: blocks-grid', $css);
    }

    #[Test]
    public function gridRoleUsesContainerQueryBreakpoints(): void
    {
        $css = self::gridCss();

        self::assertStringContainsString('@container blocks-grid (min-width: 48rem)', $css);
        self::assertStringContainsString('@container blocks-grid (min-width: 22.01rem) and (max-width: 47.99rem)', $css);
        self::assertStringContainsString('[data-ui-part="grid-layout"]', $css);
    }
}

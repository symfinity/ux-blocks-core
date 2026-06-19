<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StatTrimTest extends TestCase
{
    private static function roleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/stat.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function valueUsesBalanceAndCapTrim(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-role="stat-value"]', $css);
        self::assertStringContainsString('[data-ui-role="stat"] [data-ui-part="value"]', $css);
        self::assertStringContainsString('text-wrap: balance', $css);
        self::assertStringContainsString('text-box: trim-both cap alphabetic', $css);
        self::assertStringContainsString('@supports (text-box: trim-both)', $css);
    }

    #[Test]
    public function labelUsesExTrim(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-role="stat-label"]', $css);
        self::assertStringContainsString('[data-ui-role="stat"] [data-ui-part="label"]', $css);
        self::assertStringContainsString('text-box: trim-both ex alphabetic', $css);
    }

    #[Test]
    public function compactDensityDisablesTrimAndBalance(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-role="stat"][data-ui-density="compact"]', $css);
        self::assertStringContainsString('text-box: normal', $css);
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="stat"\]\[data-ui-density="compact"\][\s\S]*text-wrap: wrap/',
            $css,
        );
    }
}

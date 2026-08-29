<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;

final class SurfaceGlassCssTest extends TestCase
{
    private static function surfaceGlassCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/surface-glass.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    private static function fullCss(): string
    {
        return (new BlocksCoreCssProvider(dirname(__DIR__, 3)))->stylesheet();
    }

    #[Test]
    public function surfaceGlassSheetIsBundled(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-surface="glass"]', $css);
    }

    #[Test]
    public function legibilityLadderIncludesAllFourRungs(): void
    {
        $css = self::surfaceGlassCss();

        self::assertStringContainsString('background: var(--ui-glass-fallback-surface)', $css);
        self::assertStringContainsString('border: 1px solid var(--ui-glass-border)', $css);
        self::assertStringContainsString('box-shadow: var(--ui-shadow-lg)', $css);
        self::assertStringContainsString('@supports ((backdrop-filter: blur(1px)) or (-webkit-backdrop-filter: blur(1px)))', $css);
        self::assertStringContainsString('-webkit-backdrop-filter: blur(var(--ui-glass-blur)) saturate(var(--ui-glass-saturate))', $css);
        self::assertStringContainsString('backdrop-filter: blur(var(--ui-glass-blur)) saturate(var(--ui-glass-saturate))', $css);
        self::assertStringContainsString('background: var(--ui-glass-tint)', $css);
        self::assertStringContainsString('@media (prefers-reduced-transparency: reduce), (prefers-contrast: more)', $css);
        self::assertStringContainsString('-webkit-backdrop-filter: none', $css);
        self::assertStringContainsString('backdrop-filter: none', $css);
    }

    #[Test]
    public function allowlistedRolesDeferSolidFillsWhenGlass(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-role="flash"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('[data-ui-role="alert"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('[data-ui-role="card"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('[data-ui-role="hero"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('[data-ui-role="content-section"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('[data-ui-role="data-table-chrome-toolbar"][data-ui-surface="glass"]', $css);
        self::assertStringContainsString('backdrop-filter: blur(var(--ui-glass-blur))', $css);
        self::assertStringContainsString('[data-ui-role="navbar"][data-ui-surface="glass"] > [data-ui-part="navbar-chrome"]', $css);
    }

    #[Test]
    public function surfaceGlassUsesKernelTokensOnly(): void
    {
        $css = self::surfaceGlassCss();

        self::assertMatchesRegularExpression('/var\(--ui-glass-/', $css);
        self::assertStringContainsString('blur(var(--ui-glass-blur))', $css);
        self::assertDoesNotMatchRegularExpression('/rgba?\(/', $css);
    }
}

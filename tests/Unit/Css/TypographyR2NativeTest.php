<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TypographyR2NativeTest extends TestCase
{
    private static function roleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/typography.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    private static function mixinCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/mixins/_typography-r2.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function proseUsesPrettyWrapOnContainerOnly(): void
    {
        $css = self::roleCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-variant="prose"\][\s\S]*text-wrap: pretty/',
            $css,
        );
        self::assertDoesNotMatchRegularExpression(
            '/\[data-ui-variant="prose"\][\s\S]*text-box:/',
            $css,
        );
    }

    #[Test]
    public function leadUsesTrimInsideSupportsGate(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('@supports (text-box: trim-both)', $css);
        self::assertMatchesRegularExpression(
            '/\[data-ui-variant="lead"\][\s\S]*text-box: trim-both cap alphabetic/',
            $css,
        );
    }

    #[Test]
    public function mutedHasNoTrimRules(): void
    {
        $css = self::roleCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-variant="muted"\][\s\S]*text-wrap: wrap/',
            $css,
        );
        self::assertDoesNotMatchRegularExpression(
            '/\[data-ui-variant="muted"\][\s\S]*text-box:/',
            $css,
        );
    }

    #[Test]
    public function proseDescendantSpacingRemainsScoped(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="prose"] p', $css);
        self::assertDoesNotMatchRegularExpression('/^p\s*\{/m', $css);
    }

    #[Test]
    public function printMediaDisablesTrimOnBalancedNodes(): void
    {
        $css = self::mixinCss();

        self::assertStringContainsString('@media print', $css);
        self::assertStringContainsString('text-box: normal', $css);
    }
}

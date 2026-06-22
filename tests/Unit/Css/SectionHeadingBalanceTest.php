<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class SectionHeadingBalanceTest extends TestCase
{
    private static function roleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/section-heading.css';
        self::assertFileExists($path);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function titleUsesBalanceAndMeasureConstraint(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-part="title"]', $css);
        self::assertStringContainsString('text-wrap: balance', $css);
        self::assertStringContainsString('max-inline-size: var(--ui-measure-heading, 65ch)', $css);
    }

    #[Test]
    public function titleTrimIsProgressivelyEnhanced(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('@supports (text-box: trim-both)', $css);
        self::assertStringContainsString('text-box: trim-both cap alphabetic', $css);
    }

    #[Test]
    public function descriptionUsesNormalWrapWithoutTrim(): void
    {
        $css = self::roleCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-part="description"\][\s\S]*text-wrap: wrap/',
            $css,
        );
    }
}

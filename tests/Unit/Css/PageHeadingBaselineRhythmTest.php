<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class PageHeadingBaselineRhythmTest extends TestCase
{
    private static function roleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/page-heading.css';
        self::assertFileExists($path);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function baselineRhythmIsOptInOnly(): void
    {
        $css = self::roleCss();

        self::assertStringContainsString('[data-ui-rhythm="baseline"]', $css);
        self::assertStringContainsString('--ui-baseline: calc(1rlh / 3)', $css);
    }

    #[Test]
    public function titleAndDescriptionUseRoundUpAgainstBaseline(): void
    {
        $css = self::roleCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-rhythm="baseline"\][\s\S]*\[data-ui-part="title"\][\s\S]*round\(up,/',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-part="description"\][\s\S]*round\(up,/',
            $css,
        );
    }
}

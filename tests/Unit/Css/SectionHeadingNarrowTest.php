<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class SectionHeadingNarrowTest extends TestCase
{
    #[Test]
    public function headingRowWrapsAndLevelOneMatchesTheRenderedHeading(): void
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/section-heading.css';
        self::assertFileExists($path);
        $css = RoleCssAssert::normalize((string) file_get_contents($path));

        self::assertMatchesRegularExpression(
            '/\[data-ui-part="row"\]\s*\{[^}]*flex-wrap:\s*wrap/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-part="title-stack"\]\s*\{[^}]*flex:\s*1 1 16rem[^}]*min-width:\s*0/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-part="actions"\]\s*\{[^}]*flex-wrap:\s*wrap/s',
            $css,
        );
        self::assertStringContainsString('flex-shrink: 0', $css);
        self::assertStringNotContainsString(':has([data-ui-part="title"] h1)', $css);
        self::assertStringContainsString(':has(h1[data-ui-part="title"])', $css);
    }
}

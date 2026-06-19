<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CatalogMatrixLayoutAtomTest extends TestCase
{
    private static function catalogTemplate(): string
    {
        $path = dirname(__DIR__, 3) . '/templates/catalog.html.twig';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function catalogMatrixGivesLayoutAtomFiguresDefiniteWidth(): void
    {
        $html = self::catalogTemplate();

        self::assertStringContainsString(':has([data-ui-role="stack"])', $html);
        self::assertStringContainsString(':has([data-ui-role="grid"])', $html);
        self::assertStringContainsString(':has([data-ui-role="aspect-ratio"])', $html);
        self::assertStringContainsString('min-width: 14rem', $html);
        self::assertStringContainsString('max-width: min(48rem, 100%)', $html);
        self::assertStringContainsString('#role-stack-direction', $html);
    }
}

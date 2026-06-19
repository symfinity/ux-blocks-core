<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ContainerStyleQueryTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path, $role);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function gridExposesDensityTokenAndStyleQueries(): void
    {
        $css = self::roleCss('grid');

        self::assertStringContainsString('--ui-density: comfortable', $css);
        self::assertStringContainsString('@container blocks-grid style(--ui-density: compact)', $css);
        self::assertStringContainsString('@supports not (container-type: style)', $css);
    }

    #[Test]
    public function stackExposesDensityTokenAndStyleQueries(): void
    {
        $css = self::roleCss('stack');

        self::assertStringContainsString('--ui-density: comfortable', $css);
        self::assertStringContainsString('@container blocks-stack style(--ui-density: compact)', $css);
        self::assertStringContainsString('@container blocks-stack style(--ui-density: spacious)', $css);
    }
}

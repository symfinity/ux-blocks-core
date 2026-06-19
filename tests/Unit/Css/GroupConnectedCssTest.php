<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GroupConnectedCssTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path, $role);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function buttonGroupConnectsAdjacentButtons(): void
    {
        $css = self::roleCss('button');

        self::assertStringContainsString('[data-ui-role="button-group"] > [data-ui-role="button"]:not(:first-child)', $css);
        self::assertStringContainsString('margin-inline-start: -1px', $css);
        self::assertStringContainsString('border-start-start-radius: 0', $css);
        self::assertStringContainsString('border-start-end-radius: 0', $css);
    }

    #[Test]
    public function inputGroupConnectsAdjacentControls(): void
    {
        $css = self::roleCss('input-group');

        self::assertStringContainsString('[data-ui-role="input-group"] > :not(:first-child)', $css);
        self::assertStringContainsString('margin-inline-start: -1px', $css);
        self::assertStringContainsString('[data-ui-role="input-group"] > [data-ui-role="input"]', $css);
        self::assertStringContainsString('flex: 1 1 auto', $css);
    }
}

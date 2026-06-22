<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class GroupConnectedCssTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path, $role);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function buttonGroupConnectsAdjacentButtons(): void
    {
        $css = self::roleCss('button-group');

        self::assertStringContainsString('[data-ui-role="button-group"] > [data-ui-role="button"] ~ [data-ui-role="button"]', $css);
        self::assertStringContainsString('margin-inline-start: -1px', $css);
        self::assertStringContainsString('border-start-start-radius: 0', $css);
        self::assertStringContainsString('border-start-end-radius: 0', $css);
    }

    #[Test]
    public function inputGroupConnectsAdjacentControls(): void
    {
        self::markTestSkipped('input-group CSS moved to symfinity/ux-blocks-form (110).');
    }
}

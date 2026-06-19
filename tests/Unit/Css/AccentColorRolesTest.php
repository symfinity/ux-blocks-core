<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AccentColorRolesTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path, $role);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function checkboxRoleUsesAccentToken(): void
    {
        $css = self::roleCss('checkbox');

        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $css);
    }

    #[Test]
    public function radioRoleUsesAccentToken(): void
    {
        $css = self::roleCss('radio');

        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $css);
    }

    #[Test]
    public function switchRoleUsesAccentToken(): void
    {
        $css = self::roleCss('switch');

        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $css);
    }

    #[Test]
    public function progressRoleUsesAccentToken(): void
    {
        $css = self::roleCss('progress');

        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $css);
    }
}

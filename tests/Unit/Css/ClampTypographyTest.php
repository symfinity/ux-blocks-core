<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class ClampTypographyTest extends TestCase
{
    private static function providerCss(): string
    {
        $packageDir = dirname(__DIR__, 3);

        return RoleCssAssert::normalize((new BlocksCoreCssProvider($packageDir))->stylesheet());
    }

    #[Test]
    public function fluidClampRulesArePresentOnHeadingAndTypographyRoles(): void
    {
        $rolesDir = dirname(__DIR__, 3) . '/assets/styles/roles';

        foreach (['page-heading', 'section-heading', 'stat', 'typography'] as $role) {
            $css = (string) file_get_contents($rolesDir . '/' . $role . '.css');
            self::assertStringContainsString('clamp(', $css, $role);
        }

        $css = self::providerCss();
        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="h1"]', $css);
    }
}

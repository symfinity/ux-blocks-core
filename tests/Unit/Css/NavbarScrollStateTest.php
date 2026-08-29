<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class NavbarScrollStateTest extends TestCase
{
    private static function navbarCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/navbar.css';
        self::assertFileExists($path);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function navbarUsesScrollStateContainerOnStickyShell(): void
    {
        $css = self::navbarCss();

        self::assertStringContainsString('[data-ui-part="navbar-sticky"]', $css);
        self::assertStringContainsString('container-type: scroll-state', $css);
        self::assertStringContainsString('container-name: navbar-sticky', $css);
        self::assertStringContainsString('@container scroll-state(stuck: block-start)', $css);
        self::assertStringContainsString('[data-ui-part="navbar-chrome"]', $css);
        self::assertStringContainsString('background: transparent', $css);
        self::assertStringContainsString('[data-ui-role="navbar"][data-ui-part="navbar-sticky"] > [data-ui-part="navbar-chrome"]', $css);
        self::assertStringContainsString('border-block-end-color: var(--ui-color-border)', $css);
    }

    #[Test]
    public function navbarProvidesScrollStateFallback(): void
    {
        $css = self::navbarCss();

        self::assertStringContainsString('@supports not (container-type: scroll-state)', $css);
    }
}

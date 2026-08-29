<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class HasNavCurrentTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path, $role);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function navbarStylesActiveItemViaHasAriaCurrentPage(): void
    {
        $css = self::roleCss('navbar');

        self::assertStringContainsString(':has([aria-current="page"])', $css);
    }

    #[Test]
    public function breadcrumbStylesActiveItemViaHasAriaCurrentPage(): void
    {
        $css = self::roleCss('breadcrumb');

        self::assertStringContainsString(':has([aria-current="page"])', $css);
    }

    #[Test]
    public function breadcrumbDividerVariantsUseBeforePseudoOnTrailingItems(): void
    {
        $css = self::roleCss('breadcrumb');

        self::assertStringContainsString(':not([data-ui-divider="none"]) li + li::before', $css);
        self::assertStringContainsString('[data-ui-divider="chevron"]', $css);
        self::assertStringContainsString('[data-ui-divider="gt"]', $css);
        self::assertStringContainsString('content: "/"', $css);
    }
}

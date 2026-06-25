<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/** symfinity 122 — shell card/dialog promoted from ui-profiler owned CSS */
final class ShellDelegationRoleCssTest extends TestCase
{
    private static function roleCss(string $role): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/' . $role . '.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function cardUsesTableAdjacentInsetChrome(): void
    {
        $css = self::roleCss('card');

        self::assertStringContainsString('[data-ui-role=card]', $css);
        self::assertStringContainsString(
            'box-shadow: inset 0 0 0 1px var(--ui-color-border), 0 0 0 5px var(--ui-color-surface)',
            $css,
        );
        self::assertStringNotContainsString('padding: var(--ui-space-lg)', $css);
    }

    #[Test]
    public function dialogIncludesNativeBackdropAndHeaderChrome(): void
    {
        $css = self::roleCss('dialog');

        self::assertStringContainsString('[data-ui-role=dialog]::backdrop', $css);
        self::assertStringContainsString('backdrop-filter: blur(2px)', $css);
        self::assertStringContainsString('[data-ui-role=dialog] header', $css);
    }

    #[Test]
    public function tableIncludesStatusRowBackgrounds(): void
    {
        $css = self::roleCss('table');

        self::assertStringContainsString('tr.status-success td', $css);
        self::assertStringContainsString('tr.status-warning td', $css);
    }

    #[Test]
    public function linkIncludesSfToggleReset(): void
    {
        $css = self::roleCss('link');

        self::assertStringContainsString('a.sf-toggle', $css);
        self::assertStringContainsString('button.sf-toggle', $css);
    }

    #[Test]
    public function pageHeadingIncludesPanelVariantChrome(): void
    {
        $css = self::roleCss('page-heading');

        self::assertStringContainsString('[data-ui-role=page-heading][data-ui-variant=panel]', $css);
    }

    #[Test]
    public function tabsIncludesHiddenPanelTitleHook(): void
    {
        $css = self::roleCss('tabs');

        self::assertStringContainsString('[data-ui-role=tabs] > .tab > :is(h2, h3).tab-title', $css);
    }
}

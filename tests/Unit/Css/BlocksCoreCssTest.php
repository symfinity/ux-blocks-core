<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;

final class BlocksCoreCssTest extends TestCase
{
    private static function packageDir(): string
    {
        return dirname(__DIR__, 3);
    }

    private static function bundleCss(): string
    {
        $path = self::packageDir() . '/assets/styles/roles/_bundle.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    private static function fullCss(): string
    {
        return (new BlocksCoreCssProvider(self::packageDir()))->stylesheet();
    }

    #[Test]
    public function bundleIncludesV0PrimitiveRoles(): void
    {
        $css = self::fullCss();

        foreach ([
            'button', 'label', 'input', 'textarea', 'select', 'checkbox', 'radio-group',
            'separator',
        ] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }
    }

    #[Test]
    public function bundleIncludesV1CoreRoles(): void
    {
        $css = self::fullCss();

        foreach ([
            'scroll-area', 'aspect-ratio', 'divider', 'spinner', 'progress', 'badge', 'avatar',
            'link', 'switch', 'file-input', 'kbd', 'figure', 'image', 'skeleton',
            'breadcrumb',
        ] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }

        self::assertStringContainsString('@keyframes ui-spin', $css);
    }

    #[Test]
    public function bundleDoesNotOwnExtendedRegistryRootRoles(): void
    {
        $css = self::bundleCss();

        foreach (['card', 'field', 'accordion', 'dialog', 'popover'] as $role) {
            self::assertDoesNotMatchRegularExpression(
                '/^\[data-ui-role="' . preg_quote($role, '/') . '"\]/m',
                $css,
                $role,
            );
        }
    }

    #[Test]
    public function buttonSemanticVariantsAndFocusRingArePresent(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-role="button"][data-ui-variant="primary"][data-ui-appearance="outline"]', $css);
        self::assertStringContainsString('[data-ui-role="button"]:focus-visible', $css);
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="button"\]\[data-ui-variant="primary"\]\[data-ui-appearance="solid"\][^{]*\{[^}]*color:\s*var\(--ui-color-on-primary\)/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="button"\]\[data-ui-variant="primary"\]\[data-ui-appearance="outline"\][^{]*\{[^}]*color:\s*var\(--ui-color-primary\)/s',
            $css,
        );
        self::assertStringContainsString('appearance: none', $css);
        self::assertStringContainsString('[data-ui-role="button"] [data-ui-part="icon"] svg', $css);
        self::assertStringContainsString('[data-ui-role="avatar"][data-ui-variant="primary"]', $css);
        self::assertStringContainsString('[data-ui-role="badge"][data-ui-variant="ghost"]', $css);
    }

    #[Test]
    public function skeletonRulesArePresent(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="skeleton"]', $css);
        self::assertStringContainsString('[data-ui-role="skeleton"][data-ui-variant="text"]', $css);
        self::assertStringContainsString('height: 1lh', $css);
        self::assertStringContainsString('[data-ui-role="skeleton"][data-ui-variant="fill"]', $css);
        self::assertStringContainsString('[data-ui-role="skeleton"][data-ui-variant="circle"]', $css);
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="skeleton"\]\[data-ui-variant="circle"\][^{]*\{[^}]*border:\s*none/s',
            $css,
        );
        self::assertStringContainsString('[data-ui-role="avatar"]:has(> [data-ui-role="skeleton"][data-ui-variant="circle"])', $css);
        self::assertStringNotContainsString('[data-ui-variant="rect"]', $css);
        self::assertStringNotContainsString('[data-ui-variant="card"]', $css);
        self::assertStringContainsString('@media (prefers-reduced-motion: reduce)', $css);
    }

    #[Test]
    public function toggleSplitRoleSheetsUseTokenChrome(): void
    {
        $rolesDir = dirname(__DIR__, 3) . '/assets/styles/roles';

        foreach (['checkbox', 'radio', 'switch'] as $role) {
            $css = (string) file_get_contents($rolesDir . '/' . $role . '.css');
            self::assertStringContainsString('--ui-toggle-track:', $css, $role);
            self::assertStringContainsString('appearance: none', $css, $role);
            self::assertStringNotContainsString('appearance: auto', $css, $role);
        }

        $progressCss = (string) file_get_contents($rolesDir . '/progress.css');
        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $progressCss);

        $bundle = self::bundleCss();
        self::assertStringContainsString('[data-ui-part="form-check"]', $bundle);
    }

    #[Test]
    public function formCheckAndSwitchDisabledRulesExist(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-part="form-check"]', $css);
        self::assertStringContainsString('[data-ui-part="form-check"] [data-ui-role="label"]', $css);
        self::assertStringContainsString('[data-ui-role="switch"]:disabled', $css);
        self::assertStringContainsString('[data-ui-role="switch"][data-ui-state="disabled"]', $css);
        self::assertStringContainsString('[data-ui-role="checkbox"]:focus-visible', $css);
        self::assertStringContainsString('[data-ui-role="radio-group"]', $css);
    }

    #[Test]
    public function switchSplitRoleUsesCustomToggleChrome(): void
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/switch.css';
        $css = (string) file_get_contents($path);

        self::assertStringContainsString('--ui-toggle-accent:', $css);
        self::assertStringContainsString('background-position: right center', $css);
        self::assertStringContainsString('appearance: none', $css);
        self::assertStringNotContainsString('appearance: auto', $css);
    }

    #[Test]
    public function flashRulesArePresent(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-role="flash"]', $css);
        self::assertStringContainsString('[data-ui-role="flash-stack"]', $css);
        self::assertStringContainsString('--ux-flash-stack-stagger: 500ms', $css);
        self::assertStringContainsString('--ux-flash-stack-order', $css);
        self::assertStringContainsString('[data-ui-role="flash-stack"] > [data-ui-role="flash"][data-ui-auto-dismiss]', $css);
        self::assertStringContainsString('@keyframes ux-flash-enter-top', $css);
        self::assertStringContainsString('--ux-flash-tone', $css);
        self::assertStringContainsString('html:not([data-theme$="-dark"]) [data-ui-role="flash"]', $css);
        self::assertStringContainsString('color-mix(in srgb, var(--ux-flash-tone) 14%, #ffffff)', $css);
        self::assertStringContainsString('color-mix(in srgb, var(--ux-flash-tone) 70%, black)', $css);
        self::assertStringContainsString('html[data-theme$="-dark"] [data-ui-role="flash"]', $css);
        self::assertStringNotContainsString('light-dark(', $css);
        self::assertStringNotContainsString('--ux-flash-accent', $css);
        self::assertStringContainsString('--ux-flash-shadow-color: rgb(0 0 0 / 0.28)', $css);
        self::assertStringContainsString('0 8px 20px var(--ux-flash-shadow-color)', $css);
        self::assertStringContainsString('box-shadow: var(--ux-flash-shadow)', $css);
    }

    #[Test]
    public function bundleIncludesTypographyAndHeadingRoles(): void
    {
        $css = self::fullCss();

        foreach (['page-heading', 'section-heading'] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }

        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="lead"]', $css);
        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="muted"]', $css);
        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="prose"]', $css);
    }

    #[Test]
    public function proseRulesStayScopedToProseVariant(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-role="typography"][data-ui-variant="prose"] p', $css);
        self::assertDoesNotMatchRegularExpression('/^\[data-ui-role="typography"\] p/m', $css);
    }

    #[Test]
    public function figureCaptionUsesMutedTypographyTokens(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="figure-caption"]', $css);
        self::assertStringContainsString('color: var(--ui-color-text-muted)', $css);
        self::assertStringContainsString('[data-ui-role="figure"][data-ui-align="center"]', $css);
    }

    #[Test]
    public function spinnerSizeScaleUsesDistinctSteps(): void
    {
        $css = self::bundleCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-role="spinner"\][^{]*\{[^}]*width:\s*1\.5rem/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="spinner"\]\[data-ui-size="sm"\][^{]*\{[^}]*width:\s*1rem/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="spinner"\]\[data-ui-size="lg"\][^{]*\{[^}]*width:\s*2\.5rem/s',
            $css,
        );
    }

    #[Test]
    public function badgeSizeScaleUsesDistinctSteps(): void
    {
        $css = self::fullCss();

        self::assertMatchesRegularExpression(
            '/\[data-ui-role="badge"\]\[data-ui-size="sm"\][^{]*\{[^}]*font-size:\s*0\.625rem/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="badge"\]\[data-ui-size="md"\][^{]*\{[^}]*font-size:\s*var\(--ui-font-size-sm\)/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="badge"\]\[data-ui-size="lg"\][^{]*\{[^}]*font-size:\s*var\(--ui-font-size-md\)/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="badge"\]\[data-ui-size="lg"\][^{]*\{[^}]*padding:[^}]*var\(--ui-space-md\)/s',
            $css,
        );
    }
}

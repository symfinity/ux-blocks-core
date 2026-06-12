<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class BlocksCoreCssTest extends TestCase
{
    private static function bundleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/_bundle.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function bundleIncludesV0PrimitiveRoles(): void
    {
        $css = self::bundleCss();

        foreach ([
            'button', 'label', 'input', 'textarea', 'select', 'checkbox', 'radio-group', 'empty',
            'separator',
        ] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }
    }

    #[Test]
    public function bundleIncludesV1CoreRoles(): void
    {
        $css = self::bundleCss();

        foreach ([
            'scroll-area', 'aspect-ratio', 'divider', 'spinner', 'progress', 'badge', 'avatar',
            'link', 'switch', 'file-input', 'kbd', 'figure', 'image', 'skeleton',
        ] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }

        self::assertStringContainsString('@keyframes ui-spin', $css);
    }

    #[Test]
    public function bundleDoesNotOwnExtendedRegistryRootRoles(): void
    {
        $css = self::bundleCss();

        foreach (['card', 'field', 'accordion', 'grid', 'stack', 'dialog', 'popover'] as $role) {
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
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="button"][data-ui-variant="primary"][data-ui-appearance="outline"]', $css);
        self::assertStringContainsString('[data-ui-role="button"]:focus-visible', $css);
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
    public function toggleControlsUseTokenizedTrackThumbAndAccentCustomProperties(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="radio-group"]', $css);
        self::assertStringContainsString('[data-ui-role="radio-group"][data-ui-orientation="horizontal"]', $css);
        self::assertStringContainsString('[data-ui-role="radio-group-item"]', $css);
        self::assertStringContainsString('--ui-toggle-track:', $css);
        self::assertStringContainsString('--ui-toggle-thumb: var(--ui-color-surface)', $css);
        self::assertStringContainsString('--ui-toggle-accent: var(--ui-color-primary)', $css);
        self::assertStringContainsString('[data-ui-role="checkbox"]:checked', $css);
        self::assertStringContainsString('background-color: var(--ui-toggle-accent)', $css);
        self::assertStringContainsString('[data-ui-role="radio"]:checked', $css);
        self::assertStringContainsString('radial-gradient(circle, var(--ui-toggle-accent)', $css);
        self::assertDoesNotMatchRegularExpression(
            '/\[data-ui-role="radio"\]:checked\s*\{[^}]*border-color:\s*var\(--ui-toggle-accent\)/s',
            $css,
        );
        self::assertStringNotContainsString('[data-ui-role="checkbox"] {
accent-color:', $css);
        self::assertStringNotContainsString('[data-ui-role="radio"] {
accent-color:', $css);
    }

    #[Test]
    public function formCheckAndSwitchDisabledRulesExist(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-part="form-check"]', $css);
        self::assertStringContainsString('[data-ui-part="form-check"] [data-ui-role="label"]', $css);
        self::assertStringContainsString('[data-ui-role="switch"]:disabled', $css);
        self::assertStringContainsString('[data-ui-role="switch"][data-ui-state="disabled"]', $css);
        self::assertStringContainsString('[data-ui-role="checkbox"]:focus-visible', $css);
    }

    #[Test]
    public function switchUsesPillTrackAndSlidingThumbNotNativeAccent(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="switch"]', $css);
        self::assertStringContainsString('appearance: none', $css);
        self::assertStringContainsString('radial-gradient(circle closest-side, var(--ui-toggle-thumb)', $css);
        self::assertStringContainsString('background-position: left center', $css);
        self::assertStringContainsString('background-position: right center', $css);
        self::assertStringContainsString('[data-ui-role="switch"]:checked', $css);
        self::assertStringContainsString('[data-ui-role="switch"][data-ui-variant="primary"]', $css);
        self::assertStringContainsString('--ui-toggle-accent: var(--ui-color-primary)', $css);
        self::assertStringNotContainsString('[data-ui-role="switch"][data-ui-variant="primary"] {
accent-color:', $css);
    }

    #[Test]
    public function figureCaptionUsesMutedTypographyTokens(): void
    {
        $css = self::bundleCss();

        self::assertStringContainsString('[data-ui-role="figure-caption"]', $css);
        self::assertStringContainsString('color: var(--ui-color-text-muted)', $css);
        self::assertStringContainsString('[data-ui-role="figure"][data-ui-align="center"]', $css);
    }
}

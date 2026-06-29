<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

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

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    private static function fullCss(): string
    {
        return RoleCssAssert::normalize((new BlocksCoreCssProvider(self::packageDir()))->stylesheet());
    }

    #[Test]
    public function bundleIncludesV0PrimitiveRoles(): void
    {
        $css = self::fullCss();

        foreach ([
            'button', 'separator',
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
            'link', 'kbd', 'figure', 'image', 'skeleton',
            'breadcrumb',
        ] as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }

        self::assertStringContainsString('@keyframes ui-spin', $css);
    }

    public function bundleIncludesShellDelegationRoles(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('[data-ui-role="card"]', $css);
        self::assertStringContainsString('[data-ui-role="dialog"]', $css);
        self::assertStringContainsString(
            'inset 0 0 0 1px var(--ui-color-border), 0 0 0 5px var(--ui-color-surface)',
            $css,
        );
        self::assertStringContainsString('[data-ui-role="dialog"]::backdrop', $css);
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
        self::assertStringContainsString('html[data-theme$=-dark] [data-ui-role="button"][data-ui-variant="primary"][data-ui-appearance="soft"]', $css);
        self::assertStringContainsString('color: color-mix(in srgb, var(--ux-soft-tone) 88%, white)', $css);
        self::assertStringContainsString('background-color: color-mix(in srgb, var(--ux-soft-tone) 32%, var(--ui-color-surface-elevated))', $css);
        self::assertStringContainsString('appearance: none', $css);
        self::assertStringContainsString('[data-ui-role="button"] [data-ui-part="icon"] svg', $css);
        self::assertStringContainsString('[data-ui-role="avatar"][data-ui-variant="primary"]', $css);
        self::assertStringContainsString('[data-ui-role="badge"][data-ui-variant="neutral"]', $css);
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

        $progressCss = (string) file_get_contents($rolesDir . '/progress.css');
        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $progressCss);
    }

    #[Test]
    public function formCheckAndSwitchDisabledRulesExist(): void
    {
        self::markTestSkipped('Form control CSS moved to symfinity/ux-blocks-form (110).');
    }

    #[Test]
    public function switchSplitRoleUsesCustomToggleChrome(): void
    {
        self::markTestSkipped('Switch CSS moved to symfinity/ux-blocks-form (110).');
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
        self::assertStringContainsString('html:not([data-theme$=-dark]) [data-ui-role="flash"]', $css);
        self::assertStringContainsString('color-mix(in srgb, var(--ux-flash-tone) 14%, var(--ui-color-surface))', $css);
        self::assertStringContainsString('color-mix(in srgb, var(--ux-flash-tone) 70%, black)', $css);
        self::assertStringContainsString('html[data-theme$=-dark] [data-ui-role="flash"]', $css);
        self::assertStringNotContainsString('light-dark(', $css);
        self::assertStringNotContainsString('--ux-flash-accent', $css);
        self::assertStringContainsString('--ux-flash-shadow-color: color-mix(in oklch, black 28%, transparent)', $css);
        self::assertStringContainsString('0 8px 20px var(--ux-flash-shadow-color)', $css);
        self::assertStringContainsString('box-shadow: var(--ux-flash-shadow)', $css);
        self::assertStringContainsString('[data-ui-role="flash"][data-ui-variant="danger"]', $css);
        self::assertStringContainsString('--ux-flash-tone: var(--ui-color-danger)', $css);
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

    #[Test]
    public function feedbackIconSlotUsesDoubledSizeToken(): void
    {
        $css = self::fullCss();

        self::assertStringContainsString('--ux-feedback-icon-slot-size: 2.5rem', $css);
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="flash"\][^{]*\[data-ui-part="icon"\]:has\(:is\(svg, img\)\)[^{]*\{[^}]*width:\s*var\(--ux-feedback-icon-slot-size\)/s',
            $css,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-part="flash-body"\][^{]*\{[^}]*align-items:\s*center/s',
            $css,
        );
    }

    #[Test]
    public function entryImportsHaveNoDuplicatePrimaryRoleSelectors(): void
    {
        $entryPath = self::packageDir() . '/assets/styles/blocks-core.css';
        self::assertFileExists($entryPath);

        $entry = (string) file_get_contents($entryPath);
        preg_match_all("/@import\\s+url\\('([^']+)'\\)\\s*;/", $entry, $matches);
        self::assertNotEmpty($matches[1]);

        $seen = [];
        $stylesDir = self::packageDir() . '/assets/styles/';

        foreach ($matches[1] as $importPath) {
            if (!str_starts_with($importPath, 'roles/')) {
                continue;
            }

            $cssPath = $stylesDir . $importPath;
            self::assertFileExists($cssPath, $importPath);

            foreach (self::extractOwningRoleSelectors((string) file_get_contents($cssPath)) as $role) {
                self::assertArrayNotHasKey(
                    $role,
                    $seen,
                    sprintf('Role "%s" appears in both %s and %s', $role, $seen[$role] ?? '?', $importPath),
                );
                $seen[$role] = $importPath;
            }
        }
    }

    #[Test]
    public function generatedRolesAndAuditBundleCarryCompileHeader(): void
    {
        $header = '/* generated: blocks-css:compile — do not edit */';

        foreach (['roles/_bundle.css'] as $relative) {
            $path = self::packageDir() . '/assets/styles/' . $relative;
            self::assertFileExists($path, $relative);
            self::assertStringContainsString($header, (string) file_get_contents($path), $relative);
        }
    }

    /**
     * @return list<string>
     */
    private static function extractOwningRoleSelectors(string $css): array
    {
        $roles = [];
        $parts = preg_split('/\{(?:[^{}]|\{[^{}]*\})*\}/', $css) ?: [];
        foreach ($parts as $selectorBlock) {
            foreach (explode(',', $selectorBlock) as $part) {
                $part = trim($part);
                if ('' === $part || str_starts_with($part, '@')) {
                    continue;
                }

                if (!preg_match('/^\[data-ui-role="?([^"\]]+)"?\](?:\[[^\]]+\])*\s*$/', $part, $matches)) {
                    continue;
                }

                $roles[] = $matches[1];
            }
        }

        return array_values(array_unique($roles));
    }
}

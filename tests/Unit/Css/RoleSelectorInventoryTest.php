<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

/**
 * 120 SC-003 — primary role selector inventory for coverage measurement.
 */
final class RoleSelectorInventoryTest extends TestCase
{
    /**
     * Literal selector inventory — scanned by {@see \Symfinity\UxBlocks\DevTools\CssSelectorCoverageReporter}.
     */
    private const SELECTOR_INVENTORY = <<<'SELECTORS'
[data-ui-role="aspect-ratio"]
[data-ui-role="avatar"]
[data-ui-role="divider"]
[data-ui-role="empty"]
[data-ui-role="empty-content"]
[data-ui-role="empty-description"]
[data-ui-role="empty-header"]
[data-ui-role="empty-title"]
[data-ui-role="figure"]
[data-ui-role="figure-caption"]
[data-ui-role="image"]
[data-ui-role="kbd"]
[data-ui-role="nav"]
[data-ui-role="scroll-area"]
[data-ui-role="separator"]
[data-ui-role="skeleton"]
[data-ui-role="spinner"]
[data-ui-role="typography"]
SELECTORS;

    private static function bundleCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/_bundle.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
    }

    #[Test]
    public function bundleIncludesPrimaryRoleSelectors(): void
    {
        $css = self::bundleCss();

        foreach (self::inventoryRoles() as $role) {
            self::assertStringContainsString('[data-ui-role="' . $role . '"]', $css, $role);
        }
    }

    /**
     * @return list<string>
     */
    private static function inventoryRoles(): array
    {
        preg_match_all('/\[data-ui-role="([^"]+)"\]/', self::SELECTOR_INVENTORY, $matches);

        return $matches[1];
    }
}

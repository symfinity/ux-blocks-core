<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Tests\Support\RoleCssAssert;

final class StackContainerQueryTest extends TestCase
{
    private static function stackCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/stack.css';
        self::assertFileExists($path);

        return RoleCssAssert::normalize((string) file_get_contents($path));
    }

    #[Test]
    public function stackRoleDeclaresNamedContainer(): void
    {
        $css = self::stackCss();

        self::assertStringContainsString('[data-ui-role="stack"]', $css);
        self::assertStringContainsString('container-type: inline-size', $css);
        self::assertStringContainsString('container-name: blocks-stack', $css);
    }

    #[Test]
    public function stackRoleUsesDirectionBreakpoints(): void
    {
        $css = self::stackCss();

        self::assertStringContainsString('@container blocks-stack (max-width: 22rem)', $css);
        self::assertStringContainsString('@container blocks-stack (min-width: 48rem)', $css);
        self::assertStringContainsString('[data-ui-direction="horizontal"]', $css);
        self::assertStringContainsString('[data-ui-part="stack-layout"]', $css);
    }

    #[Test]
    public function inlineDirectionWrapsAsARowAtEveryWidth(): void
    {
        $css = self::stackCss();
        $outsideContainerQueries = preg_replace('/@container[^{]*\{(?:[^{}]*\{[^{}]*\})*[^{}]*\}/', '', $css) ?? '';

        self::assertMatchesRegularExpression(
            '/\[data-ui-role="stack"\]\[data-ui-direction="inline"\] > \[data-ui-part="stack-layout"\] \{[^}]*flex-direction: row;[^}]*flex-wrap: wrap;/',
            $outsideContainerQueries,
        );
        self::assertMatchesRegularExpression(
            '/\[data-ui-role="stack"\]\[data-ui-direction="inline"\] > \[data-ui-part="stack-layout"\] > \* \{[^}]*flex: 0 1 auto;/',
            $outsideContainerQueries,
        );
    }

    #[Test]
    public function horizontalDirectionStillWaitsForTheBreakpoint(): void
    {
        $css = self::stackCss();

        self::assertMatchesRegularExpression(
            '/@container blocks-stack \(min-width: 48rem\) \{\s*\[data-ui-role="stack"\]\[data-ui-direction="horizontal"\] > \[data-ui-part="stack-layout"\] \{\s*flex-direction: row;\s*flex-wrap: wrap;\s*align-items: flex-start;\s*\}\s*\}/',
            $css,
        );
    }
}

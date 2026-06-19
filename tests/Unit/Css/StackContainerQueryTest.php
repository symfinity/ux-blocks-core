<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StackContainerQueryTest extends TestCase
{
    private static function stackCss(): string
    {
        $path = dirname(__DIR__, 3) . '/assets/styles/roles/stack.css';
        self::assertFileExists($path);

        return (string) file_get_contents($path);
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
}

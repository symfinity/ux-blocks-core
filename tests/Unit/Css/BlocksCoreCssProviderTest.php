<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Css;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;

final class BlocksCoreCssProviderTest extends TestCase
{
    #[Test]
    public function itInlinesSplitRoleStylesheetsForWorkshopPreview(): void
    {
        $packageDir = \dirname(__DIR__, 3);
        $provider = new BlocksCoreCssProvider($packageDir);
        $css = $provider->stylesheet();

        self::assertStringContainsString('[data-ui-role="button"][data-ui-variant="primary"][data-ui-appearance="solid"]', $css);
        self::assertStringContainsString('[data-ui-role="badge"][data-ui-variant="danger"]', $css);
        self::assertStringContainsString('[data-ui-role="link"][data-ui-variant="primary"][data-ui-appearance="outline"]', $css);
        self::assertStringContainsString('[data-ui-role="input"][data-ui-variant="danger"]', $css);
        self::assertStringContainsString('[data-ui-part="input-adornment"]', $css);
        self::assertStringContainsString('display: flex', $css);
        self::assertStringContainsString('[data-ui-part="input-adornment"]:has([data-ui-role="input"][aria-invalid="true"])', $css);
        self::assertStringContainsString('color: var(--ui-color-danger)', $css);
        self::assertStringContainsString('accent-color: var(--ui-color-accent)', $css);
        self::assertStringContainsString(':has([aria-current="page"])', $css);
        self::assertStringContainsString('container-name: blocks-grid', $css);
        self::assertStringContainsString('container-name: blocks-stack', $css);
        self::assertStringContainsString('container-name: blocks-list', $css);
    }
}

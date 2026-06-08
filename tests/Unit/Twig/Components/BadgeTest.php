<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class BadgeTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Badge', ['variant' => 'success']);

        $this->assertRootAttributes($html, 'badge', 'blocks.badge');
        self::assertStringContainsString('data-ui-variant="success"', $html);
    }

    #[Test]
    public function defaultBadgeUsesPrimaryVariant(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Badge', ['content' => 'Badge']);

        $this->assertRootAttributes($html, 'badge', 'blocks.badge');
        self::assertStringContainsString('data-ui-variant="primary"', $html);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class FlashTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', ['variant' => 'success']);

        $this->assertRootAttributes($html, 'flash', 'blocks.flash');
        self::assertStringContainsString('data-ui-variant="success"', $html);
        self::assertStringContainsString('data-ui-placement="top"', $html);
        self::assertStringNotContainsString('data-controller', $html);
    }

    #[Test]
    public function dismissAfterMapsToCssDurationVariable(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', [
            'variant' => 'info',
            'dismissAfter' => 8,
        ]);

        self::assertStringContainsString('data-ui-auto-dismiss', $html);
        self::assertStringContainsString('--ux-flash-duration: 8s', $html);
    }

    #[Test]
    public function errorVariantHasNoAutoDismiss(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', ['variant' => 'error']);

        self::assertStringNotContainsString('data-ui-auto-dismiss', $html);
        self::assertStringContainsString('role="alert"', $html);
    }

    #[Test]
    public function placementSupportsTopAndBottom(): void
    {
        self::bootKernel();
        $top = $this->renderComponent('Flash', ['placement' => 'top']);
        $bottom = $this->renderComponent('Flash', ['placement' => 'bottom']);

        self::assertStringContainsString('data-ui-placement="top"', $top);
        self::assertStringContainsString('data-ui-placement="bottom"', $bottom);
    }

    #[Test]
    public function itRendersIconSlotPart(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', ['variant' => 'success']);

        self::assertStringContainsString('data-ui-part="icon"', $html);
    }
}

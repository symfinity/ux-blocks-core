<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class FlashWatermarkTest extends ComponentTestCase
{
    #[Test]
    public function itOmitsWatermarkPartWhenPropUnset(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', ['variant' => 'info']);

        self::assertStringNotContainsString('data-ui-part="icon-watermark"', $html);
    }

    #[Test]
    public function itRendersWatermarkPartWithDefaultPosition(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', [
            'variant' => 'info',
            'iconWatermark' => 'lucide:sparkles',
        ]);

        self::assertStringContainsString('data-ui-part="icon-watermark"', $html);
        self::assertStringContainsString('data-ui-watermark-position="top-end"', $html);
        self::assertStringContainsString('aria-hidden="true"', $html);
        self::assertStringContainsString('data-ui-part="icon"', $html);
    }

    #[Test]
    public function headlessKernelRendersWatermarkWithoutUxIcons(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', [
            'variant' => 'success',
            'iconWatermark' => 'lucide:sparkles',
            'icon' => 'lucide:info',
        ]);

        self::assertStringContainsString('data-ui-part="icon-watermark"', $html);
        self::assertStringContainsString('data-ui-part="icon"', $html);
        self::assertStringNotContainsString('data-controller', $html);
    }

    #[Test]
    public function itHonorsCustomWatermarkPosition(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Flash', [
            'variant' => 'warning',
            'iconWatermark' => 'lucide:sparkles',
            'watermarkPosition' => 'center',
        ]);

        self::assertStringContainsString('data-ui-watermark-position="center"', $html);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class StackDirectionTest extends ComponentTestCase
{
    #[Test]
    public function inlineDirectionRendersAsInline(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Stack', ['direction' => 'inline'], 'Item');

        self::assertStringContainsString('data-ui-direction="inline"', $html);
    }

    #[Test]
    public function unknownDirectionFallsBackToVertical(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Stack', ['direction' => 'diagonal'], 'Item');

        self::assertStringContainsString('data-ui-direction="vertical"', $html);
    }

    #[Test]
    public function verticalAndHorizontalStayUnchanged(): void
    {
        self::bootKernel();

        $vertical = $this->renderComponent('Stack', ['direction' => 'vertical'], 'Item');
        $horizontal = $this->renderComponent('Stack', ['direction' => 'horizontal'], 'Item');

        self::assertStringContainsString('data-ui-direction="vertical"', $vertical);
        self::assertStringContainsString('data-ui-direction="horizontal"', $horizontal);
    }
}

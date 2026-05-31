<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Button;

final class ButtonTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', ['variant' => 'secondary']);

        $this->assertRootAttributes($html, 'button', 'blocks.button');
        self::assertStringContainsString('data-ui-variant="secondary"', $html);
    }
}

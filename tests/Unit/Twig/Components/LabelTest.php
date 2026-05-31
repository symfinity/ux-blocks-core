<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Label;

final class LabelTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Label', ['for' => 'email']);

        $this->assertRootAttributes($html, 'label', 'blocks.label');
        self::assertStringContainsString('for="email"', $html);
    }
}

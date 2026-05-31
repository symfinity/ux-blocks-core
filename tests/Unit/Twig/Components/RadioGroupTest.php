<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\RadioGroup;

final class RadioGroupTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('RadioGroup');

        $this->assertRootAttributes($html, 'radio-group', 'blocks.radio-group');
        self::assertStringContainsString('role="radiogroup"', $html);
    }
}

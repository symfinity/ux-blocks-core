<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Checkbox;

final class CheckboxTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Checkbox', ['checked' => true]);

        $this->assertRootAttributes($html, 'checkbox', 'blocks.checkbox');
        self::assertStringContainsString('checked', $html);
    }
}

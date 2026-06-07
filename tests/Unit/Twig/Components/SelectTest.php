<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Select;

final class SelectTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select');

        $this->assertRootAttributes($html, 'select', 'blocks.select');
    }

    #[Test]
    public function invalidPropSetsAriaInvalid(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select', ['invalid' => true]);

        self::assertStringContainsString('aria-invalid="true"', $html);
    }

    #[Test]
    public function labelPropAssociatesVisibleLabel(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select', ['label' => 'Country']);

        self::assertStringContainsString('Country', $html);
    }
}

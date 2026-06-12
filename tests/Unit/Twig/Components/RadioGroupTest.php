<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class RadioGroupTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('RadioGroup', ['orientation' => 'horizontal']);

        $this->assertRootAttributes($html, 'radio-group', 'blocks.radio-group');
        self::assertStringContainsString('role="radiogroup"', $html);
        self::assertStringContainsString('data-ui-orientation="horizontal"', $html);
    }

    #[Test]
    public function itemRendersRegistryAttributesAndName(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('RadioGroup:Item', [
            'name' => 'plan',
            'value' => 'annual',
            'checked' => true,
        ]);

        self::assertStringContainsString('data-ui-role="radio-group-item"', $html);
        self::assertStringContainsString('data-ui-role="radio"', $html);
        self::assertStringContainsString('data-ui-fragment="blocks.radio-group.item"', $html);
        self::assertStringContainsString('name="plan"', $html);
        self::assertStringContainsString('value="annual"', $html);
        self::assertStringContainsString('checked', $html);
    }
}

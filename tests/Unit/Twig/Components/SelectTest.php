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
        self::assertStringContainsString('data-ui-part="select-control"', $html);
        self::assertStringContainsString('data-ui-part="select-chevron"', $html);
    }

    #[Test]
    public function invalidPropSetsAriaInvalid(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select', ['invalid' => true]);

        self::assertStringContainsString('aria-invalid="true"', $html);
    }

    #[Test]
    public function placeholderRendersEmptyOptionAndRequired(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select', ['placeholder' => 'Choose a country']);

        self::assertStringContainsString('required', $html);
        self::assertStringContainsString('<option value="" selected disabled hidden>Choose a country</option>', $html);
    }

    #[Test]
    public function labelPropAssociatesVisibleLabel(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Select', ['label' => 'Country']);

        self::assertStringContainsString('Country', $html);
        self::assertMatchesRegularExpression('/<label[^>]*>\s*Country/s', $html);
    }
}

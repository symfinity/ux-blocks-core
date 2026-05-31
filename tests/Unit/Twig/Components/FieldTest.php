<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Field;

final class FieldTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Field', ['orientation' => 'horizontal']);

        $this->assertRootAttributes($html, 'field', 'blocks.field');
        self::assertStringContainsString('data-ui-orientation="horizontal"', $html);
    }
}

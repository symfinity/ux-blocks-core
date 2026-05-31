<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Alert;

final class AlertTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Alert', ['variant' => 'warning']);

        $this->assertRootAttributes($html, 'alert', 'blocks.alert');
        self::assertStringContainsString('data-ui-variant="warning"', $html);
    }
}

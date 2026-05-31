<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Typography;
use Symfinity\UxBlocksCore\Twig\Components\TypographyH1;
use Symfinity\UxBlocksCore\Twig\Components\TypographyP;

final class TypographyTest extends ComponentTestCase
{
    #[Test]
    public function rootRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography');
    }

    #[Test]
    public function paragraphNestedRendersSubFragment(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography:P');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography.p');
        self::assertStringContainsString('data-ui-variant="p"', $html);
    }

    #[Test]
    public function h1NestedRendersSubFragment(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography:H1');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography.h1');
        self::assertStringContainsString('data-ui-variant="h1"', $html);
    }
}

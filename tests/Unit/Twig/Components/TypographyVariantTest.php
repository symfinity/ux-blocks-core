<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class TypographyVariantTest extends ComponentTestCase
{
    #[Test]
    public function leadRendersVariantAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography:Lead');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography.lead');
        self::assertStringContainsString('data-ui-variant="lead"', $html);
    }

    #[Test]
    public function mutedRendersVariantAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography:Muted');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography.muted');
        self::assertStringContainsString('data-ui-variant="muted"', $html);
    }

    #[Test]
    public function proseRendersVariantAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Typography:Prose');

        $this->assertRootAttributes($html, 'typography', 'blocks.typography.prose');
        self::assertStringContainsString('data-ui-variant="prose"', $html);
    }
}

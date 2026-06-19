<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Textarea;

final class TextareaTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Textarea', ['invalid' => true, 'disabled' => true]);

        $this->assertRootAttributes($html, 'textarea', 'blocks.textarea');
        self::assertStringContainsString('aria-invalid="true"', $html);
        self::assertStringContainsString('data-ui-state="disabled"', $html);
        self::assertStringNotContainsString('data-ui-state="invalid"', $html);
    }

    #[Test]
    public function itRendersInvalidStateWhenNotDisabled(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Textarea', ['invalid' => true]);

        self::assertStringContainsString('aria-invalid="true"', $html);
        self::assertStringContainsString('data-ui-state="invalid"', $html);
    }
}

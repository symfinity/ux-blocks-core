<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class FileInputTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('FileInput');

        $this->assertRootAttributes($html, 'file-input', 'blocks.file-input');
        self::assertStringContainsString('type="file"', $html);
    }

    #[Test]
    public function itRendersDisabledAndInvalidStates(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('FileInput', ['disabled' => true, 'invalid' => true]);

        self::assertStringContainsString('disabled', $html);
        self::assertStringContainsString('data-ui-state="disabled"', $html);
        self::assertStringContainsString('aria-invalid="true"', $html);
        self::assertStringContainsString('data-ui-state="invalid"', $html);
    }
}

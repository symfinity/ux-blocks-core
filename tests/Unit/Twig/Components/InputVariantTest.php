<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class InputVariantTest extends ComponentTestCase
{
    #[Test]
    public function itOmitsVariantForNeutralInput(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Input', ['placeholder' => 'Name']);

        $this->assertRootAttributes($html, 'input', 'blocks.input');
        self::assertStringNotContainsString('data-ui-variant=', $html);
    }

    #[Test]
    public function itMapsInvalidToDangerVariant(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Input', [
            'invalid' => true,
            'value' => 'bad',
        ]);

        self::assertStringContainsString('data-ui-variant="danger"', $html);
        self::assertStringContainsString('aria-invalid="true"', $html);
    }

    #[Test]
    public function itRendersExplicitSuccessVariant(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Input', [
            'variant' => 'success',
            'value' => 'ok',
        ]);

        self::assertStringContainsString('data-ui-variant="success"', $html);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class ButtonVariantMatrixTest extends ComponentTestCase
{
    /** @return iterable<string, array{string, string, string}> */
    public static function matrixCells(): iterable
    {
        $variants = ['primary', 'secondary', 'accent', 'success', 'danger', 'info', 'warning', 'neutral'];
        $appearances = ['solid', 'soft', 'outline', 'ghost', 'link'];
        $sizes = ['sm', 'md', 'lg'];

        foreach ($variants as $variant) {
            foreach ($appearances as $appearance) {
                foreach ($sizes as $size) {
                    yield sprintf('%s-%s-%s', $variant, $appearance, $size) => [$variant, $appearance, $size];
                }
            }
        }
    }

    #[Test]
    #[DataProvider('matrixCells')]
    public function itRendersMatrixCellAttributes(string $variant, string $appearance, string $size): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Button', [
            'variant' => $variant,
            'appearance' => $appearance,
            'size' => $size,
        ], 'Label');

        $this->assertRootAttributes($html, 'button', 'blocks.button');
        self::assertStringContainsString(sprintf('data-ui-variant="%s"', $variant), $html);
        self::assertStringContainsString(sprintf('data-ui-appearance="%s"', $appearance), $html);
        self::assertStringContainsString(sprintf('data-ui-size="%s"', $size), $html);
        self::assertStringNotContainsString('data-ui-variant="destructive"', $html);
        self::assertStringNotContainsString('data-ui-variant="default"', $html);
        self::assertStringNotContainsString('data-ui-variant="ghost"', $html);
        self::assertStringNotContainsString('data-ui-variant="tertiary"', $html);
        self::assertStringContainsString('data-ui-part="label"', $html);
    }

    #[Test]
    public function itMapsLegacyGhostVariantToNeutralAppearanceGhost(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Button', ['variant' => 'ghost'], 'Ghost');

        self::assertStringContainsString('data-ui-variant="neutral"', $html);
        self::assertStringContainsString('data-ui-appearance="ghost"', $html);
    }

    #[Test]
    public function itMapsLegacySizeDefaultToMd(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Button', ['size' => 'default']);

        self::assertStringContainsString('data-ui-size="md"', $html);
        self::assertStringNotContainsString('data-ui-size="default"', $html);
    }

    #[Test]
    public function itRendersLoadingState(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Button', ['loading' => true], 'Saving');

        self::assertStringContainsString('data-ui-state="loading"', $html);
        self::assertStringContainsString('aria-busy="true"', $html);
        self::assertStringContainsString('disabled', $html);
    }
}

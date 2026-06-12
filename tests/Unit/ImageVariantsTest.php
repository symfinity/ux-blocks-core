<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Tests\Unit\Twig\Components\ComponentTestCase;

final class ImageVariantsTest extends ComponentTestCase
{
    #[Test]
    public function defaultImageAttributesMatchFluidVariant(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Example',
        ]);

        self::assertStringContainsString('data-ui-role="image"', $html);
        self::assertStringContainsString('data-ui-fragment="blocks.image"', $html);
        self::assertStringContainsString('data-ui-variant="fluid"', $html);
        self::assertStringContainsString('src="https://example.test/photo.jpg"', $html);
        self::assertStringContainsString('alt="Example"', $html);
        self::assertStringContainsString('loading="lazy"', $html);
    }

    /** @return array<string, array{0: string}> */
    public static function variantProvider(): array
    {
        return [
            'thumbnail' => ['thumbnail'],
            'rounded' => ['rounded'],
            'circle' => ['circle'],
        ];
    }

    #[Test]
    #[DataProvider('variantProvider')]
    public function nonDefaultVariantsExposeVariantHook(string $variant): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'variant' => $variant,
        ]);

        self::assertStringContainsString(sprintf('data-ui-variant="%s"', $variant), $html);
    }
}

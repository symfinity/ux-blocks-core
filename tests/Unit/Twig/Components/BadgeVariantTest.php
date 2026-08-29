<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class BadgeVariantTest extends ComponentTestCase
{
    /** @return iterable<string, array{string, string}> */
    public static function badgeCells(): iterable
    {
        $variants = ['primary', 'secondary', 'accent', 'success', 'danger', 'info', 'warning', 'neutral'];
        $sizes = ['sm', 'md', 'lg'];

        foreach ($variants as $variant) {
            foreach ($sizes as $size) {
                yield sprintf('%s-%s', $variant, $size) => [$variant, $size];
            }
        }
    }

    #[Test]
    #[DataProvider('badgeCells')]
    public function itRendersBadgeVariantAndSize(string $variant, string $size): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Badge', [
            'variant' => $variant,
            'size' => $size,
        ], 'Badge');

        $this->assertRootAttributes($html, 'badge', 'blocks.badge');
        self::assertStringContainsString(sprintf('data-ui-variant="%s"', $variant), $html);
        self::assertStringContainsString(sprintf('data-ui-size="%s"', $size), $html);
        self::assertStringNotContainsString('data-ui-appearance', $html);
    }
}

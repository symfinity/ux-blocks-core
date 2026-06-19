<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class LinkAppearanceTest extends ComponentTestCase
{
    /** @return iterable<string, array{string, string}> */
    public static function linkCells(): iterable
    {
        $variants = ['primary', 'danger', 'ghost'];
        $appearances = ['outline', 'link'];

        foreach ($variants as $variant) {
            foreach ($appearances as $appearance) {
                yield sprintf('%s-%s', $variant, $appearance) => [$variant, $appearance];
            }
        }
    }

    #[Test]
    #[DataProvider('linkCells')]
    public function itRendersLinkAppearanceAttributes(string $variant, string $appearance): void
    {
        self::bootKernel();

        $html = $this->renderComponent('Link', [
            'variant' => $variant,
            'appearance' => $appearance,
            'href' => '/docs',
        ], 'Read more');

        $this->assertRootAttributes($html, 'link', 'blocks.link');
        self::assertStringContainsString(sprintf('data-ui-variant="%s"', $variant), $html);
        self::assertStringContainsString(sprintf('data-ui-appearance="%s"', $appearance), $html);
        self::assertStringContainsString('href="/docs"', $html);
    }
}

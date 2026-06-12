<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class SkeletonTest extends ComponentTestCase
{
    /** @return array<string, array{0: string}> */
    public static function variantProvider(): array
    {
        return [
            'text' => ['text'],
            'fill' => ['fill'],
            'circle' => ['circle'],
        ];
    }

    #[Test]
    #[DataProvider('variantProvider')]
    public function itRendersSpanRootWithVariantAndAriaHidden(string $variant): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Skeleton', ['variant' => $variant]);

        self::assertMatchesRegularExpression(
            '/<span[^>]+data-ui-role="skeleton"[^>]+data-ui-variant="' . preg_quote($variant, '/') . '"/',
            $html,
        );
        self::assertStringContainsString('aria-hidden="true"', $html);
        self::assertStringNotContainsString('<div', $html);
    }

    #[Test]
    public function textVariantFitsInsideTypographyHeading(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '<twig:Typography:H1><twig:Skeleton variant="text" /></twig:Typography:H1>',
        );

        self::assertMatchesRegularExpression(
            '/<h1[^>]*>.*<span[^>]+data-ui-variant="text".*<\/span>.*<\/h1>/s',
            $html,
        );
    }
}

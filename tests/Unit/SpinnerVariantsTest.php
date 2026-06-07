<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Tests\Unit\Twig\Components\ComponentTestCase;

final class SpinnerVariantsTest extends ComponentTestCase
{
    #[Test]
    public function defaultSpinnerAttributesMatchPreR2Snapshot(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Spinner');

        self::assertStringContainsString('data-ui-role="spinner"', $html);
        self::assertStringContainsString('data-ui-fragment="blocks.spinner"', $html);
        self::assertStringContainsString('data-ui-size="md"', $html);
        self::assertStringContainsString('data-ui-density="inline"', $html);
        self::assertStringContainsString('role="status"', $html);
    }

    /** @return array<string, array{0: string, 1: string}> */
    public static function variantProvider(): array
    {
        return [
            'sm-inline' => ['sm', 'inline'],
            'lg-block' => ['lg', 'block'],
            'sm-block' => ['sm', 'block'],
            'lg-inline' => ['lg', 'inline'],
        ];
    }

    #[Test]
    #[DataProvider('variantProvider')]
    public function nonDefaultCombosExposeVariantHooks(string $size, string $density): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Spinner', [
            'size' => $size,
            'density' => $density,
        ]);

        self::assertStringContainsString(sprintf('data-ui-size="%s"', $size), $html);
        self::assertStringContainsString(sprintf('data-ui-density="%s"', $density), $html);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Twig\UxBlocksUiAssetsTierResolver;

final class UxBlocksUiAssetsTierResolverTest extends TestCase
{
    private UxBlocksUiAssetsTierResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new UxBlocksUiAssetsTierResolver();
    }

    #[Test]
    #[DataProvider('fragmentProvider')]
    public function itMapsFragmentIdsToTierStacks(string $fragmentId, array $expected): void
    {
        self::assertSame($expected, $this->resolver->resolveForFragmentId($fragmentId));
    }

    /**
     * @return iterable<string, array{0: string, 1: list<string>}>
     */
    public static function fragmentProvider(): iterable
    {
        yield 'core button' => ['blocks.core.button', ['core']];
        yield 'form field' => ['blocks.form.field', ['core', 'form']];
        yield 'extended card' => ['blocks.ext.card', ['core', 'form', 'extended']];
        yield 'interactive tabs' => ['blocks.int.tabs', ['core', 'form', 'extended', 'interactive']];
        yield 'live counter' => ['blocks.live.counter', ['core', 'form', 'extended', 'interactive']];
        yield 'marketing hero' => ['blocks.marketing.hero', ['core', 'marketing']];
        yield 'shop product card' => ['blocks.shop.product-card', ['core', 'marketing', 'ecommerce']];
        yield 'unknown prefix falls back to core' => ['blocks.unknown.widget', ['core']];
    }
}

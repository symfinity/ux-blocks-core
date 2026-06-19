<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Breadcrumb;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Breadcrumb\PathSegmentBreadcrumbTrailResolver;
use Symfony\Component\HttpFoundation\Request;

final class PathSegmentBreadcrumbTrailResolverTest extends TestCase
{
    private PathSegmentBreadcrumbTrailResolver $resolver;

    protected function setUp(): void
    {
        $this->resolver = new PathSegmentBreadcrumbTrailResolver();
    }

    #[Test]
    public function homePathReturnsEmptyTrail(): void
    {
        self::assertSame([], $this->resolver->resolve(Request::create('/')));
    }

    #[Test]
    public function nestedPathBuildsLinkedPrefixTrail(): void
    {
        $items = $this->resolver->resolve(Request::create('/products/bad-banana'));

        self::assertCount(3, $items);
        self::assertSame('Home', $items[0]->label);
        self::assertSame('/', $items[0]->url);
        self::assertFalse($items[0]->current);

        self::assertSame('Products', $items[1]->label);
        self::assertSame('/products', $items[1]->url);
        self::assertFalse($items[1]->current);

        self::assertSame('Bad Banana', $items[2]->label);
        self::assertNull($items[2]->url);
        self::assertTrue($items[2]->current);
    }

    #[Test]
    public function deepShopPathUsesCumulativeSegmentUrls(): void
    {
        $items = $this->resolver->resolve(Request::create('/shop/products/bad-banana'));

        self::assertCount(4, $items);
        self::assertSame('/', $items[0]->url);
        self::assertSame('Shop', $items[1]->label);
        self::assertSame('/shop', $items[1]->url);
        self::assertSame('Products', $items[2]->label);
        self::assertSame('/shop/products', $items[2]->url);
        self::assertSame('Bad Banana', $items[3]->label);
        self::assertTrue($items[3]->current);
    }

    #[Test]
    public function singleSegmentPathLinksHomeAndCurrentPage(): void
    {
        $items = $this->resolver->resolve(Request::create('/account'));

        self::assertCount(2, $items);
        self::assertSame('/', $items[0]->url);
        self::assertSame('Account', $items[1]->label);
        self::assertTrue($items[1]->current);
    }
}

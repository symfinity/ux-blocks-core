<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

final class BreadcrumbAutoTrailTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    protected static function getKernelClass(): string
    {
        return UxBlocksCoreTestKernel::class;
    }

    #[Test]
    public function breadcrumbRendersTrailFromRequestPath(): void
    {
        self::bootKernel();

        $stack = self::getContainer()->get('request_stack');
        \assert($stack instanceof \Symfony\Component\HttpFoundation\RequestStack);
        $stack->push(Request::create('/products/bad-banana'));

        $html = (string) $this->renderTwigComponent('Breadcrumb');

        self::assertStringContainsString('data-ui-fragment="blocks.breadcrumb"', $html);
        self::assertStringContainsString('href="/"', $html);
        self::assertStringContainsString('href="/products"', $html);
        self::assertStringContainsString('Products', $html);
        self::assertStringContainsString('href="/products"', $html);
        self::assertStringContainsString('Bad Banana</span>', $html);
        self::assertStringContainsString('aria-current="page"', $html);
    }

    #[Test]
    public function breadcrumbRendersNothingOnHomePath(): void
    {
        self::bootKernel();

        $stack = self::getContainer()->get('request_stack');
        \assert($stack instanceof \Symfony\Component\HttpFoundation\RequestStack);
        $stack->push(Request::create('/'));

        $html = (string) $this->renderTwigComponent('Breadcrumb');

        self::assertSame('', trim($html));
    }
}

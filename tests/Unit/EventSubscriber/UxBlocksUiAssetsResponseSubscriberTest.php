<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\EventSubscriber;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\EventSubscriber\UxBlocksUiAssetsResponseSubscriber;
use Symfinity\UxBlocksCore\Twig\UxBlocksUiAssetsRenderer;
use Symfinity\UxBlocksCore\Twig\UxBlocksUiAssetsTierResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;

final class UxBlocksUiAssetsResponseSubscriberTest extends TestCase
{
    private const STYLE = '<style id="ux-blocks-core-css">.core{}</style>';

    #[Test]
    public function itLeavesLiveComponentReRendersUntouched(): void
    {
        $request = new Request();
        $request->attributes->set('_live_component', 'SearchLive');
        $html = '<html><head></head><body><div data-ui-role="button"></div></body></html>';

        self::assertSame($html, $this->dispatch($request, $html));
    }

    #[Test]
    public function itLeavesHeadlessFragmentsUntouched(): void
    {
        $html = '<div data-ui-role="card">fragment</div>';

        self::assertSame($html, $this->dispatch(new Request(), $html));
    }

    #[Test]
    public function itInsertsStylesRightAfterHead(): void
    {
        $html = '<html><head lang="en"><title>x</title></head><body><div data-ui-role="button"></div></body></html>';

        self::assertSame(
            '<html><head lang="en">' . self::STYLE . '<title>x</title></head><body><div data-ui-role="button"></div></body></html>',
            $this->dispatch(new Request(), $html),
        );
    }

    #[Test]
    public function itSkipsDocumentsThatAlreadyCarryCoreStyles(): void
    {
        $html = '<html><head><style id="ux-blocks-core-css"></style></head><body><div data-ui-role="button"></div></body></html>';

        self::assertSame($html, $this->dispatch(new Request(), $html));
    }

    private function dispatch(Request $request, string $html): string
    {
        $requestStack = new RequestStack();
        $requestStack->push($request);

        $provider = new class {
            public function stylesheet(): string
            {
                return '.core{}';
            }
        };

        $renderer = new UxBlocksUiAssetsRenderer($requestStack, new UxBlocksUiAssetsTierResolver(), ['core' => $provider]);
        $renderer->activateForFragmentId('blocks.core.button');

        $response = new Response($html, 200, ['Content-Type' => 'text/html; charset=UTF-8']);
        $event = new ResponseEvent(
            $this->createStub(HttpKernelInterface::class),
            $request,
            HttpKernelInterface::MAIN_REQUEST,
            $response,
        );

        (new UxBlocksUiAssetsResponseSubscriber($renderer))->onResponse($event);

        return (string) $response->getContent();
    }
}

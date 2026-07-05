<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\EventSubscriber;

use Symfinity\UxBlocksCore\Twig\UxBlocksUiAssetsRenderer;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class UxBlocksUiAssetsResponseSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private readonly UxBlocksUiAssetsRenderer $uiAssetsRenderer,
    ) {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => ['onResponse', -16],
        ];
    }

    public function onResponse(ResponseEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $response = $event->getResponse();
        if (!str_contains((string) $response->headers->get('Content-Type', ''), 'html')) {
            return;
        }

        $content = $response->getContent();
        if ($content === false || !str_contains($content, 'data-ui-role')) {
            return;
        }

        if (str_contains($content, 'id="ux-blocks-core-css"')) {
            return;
        }

        $styles = $this->uiAssetsRenderer->renderInlineStylesOnce();
        if ($styles === '') {
            return;
        }

        if (preg_match('/<head\b[^>]*>/i', $content, $matches, PREG_OFFSET_CAPTURE) === 1) {
            $insertAt = $matches[0][1] + \strlen($matches[0][0]);
            $content = substr($content, 0, $insertAt) . $styles . substr($content, $insertAt);
        } else {
            $content = $styles . $content;
        }

        $response->setContent($content);
    }
}

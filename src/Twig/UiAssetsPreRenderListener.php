<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\UX\TwigComponent\Event\PreRenderEvent;

#[AsEventListener(event: PreRenderEvent::class, method: 'onPreRender', priority: 32)]
final class UiAssetsPreRenderListener
{
    public function __construct(
        private readonly UxRoleRegistry $registry,
        private readonly UxBlocksUiAssetsRenderer $uiAssetsRenderer,
    ) {
    }

    public function onPreRender(PreRenderEvent $event): void
    {
        $record = $this->registry->findByTwigComponent($event->getMetadata()->getName());
        if (null === $record) {
            return;
        }

        $this->uiAssetsRenderer->activateForFragmentId($record->fragmentId);
    }
}

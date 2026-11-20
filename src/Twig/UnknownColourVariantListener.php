<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Psr\Log\LoggerInterface;
use Symfinity\UxBlocksCore\Token\ColourPropsNormalizer;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\UX\TwigComponent\Event\PreMountEvent;

/**
 * Logs a warning when a colour `variant` falls back to the default because it is not in the vocabulary.
 *
 * The fallback itself is unchanged; this only makes a typo (`variant="nope"`) visible in the dev log.
 */
#[AsEventListener(event: PreMountEvent::class, method: 'onPreMount')]
final class UnknownColourVariantListener
{
    private readonly ColourPropsNormalizer $normalizer;

    public function __construct(
        private readonly ?LoggerInterface $logger = null,
    ) {
        $this->normalizer = new ColourPropsNormalizer();
    }

    public function onPreMount(PreMountEvent $event): void
    {
        if ($this->logger === null) {
            return;
        }

        $component = $event->getComponent();
        if (!method_exists($component, 'normalizeSemanticColourVariant')
            && !method_exists($component, 'normalizeButtonColourProps')
        ) {
            return;
        }

        $value = $event->getData()['variant'] ?? null;
        if (!\is_string($value) || $this->normalizer->isKnown($value)) {
            return;
        }

        $this->logger->warning('Unknown colour variant "{value}" on {component}, using "{default}"; allowed: {allowed}.', [
            'value' => $value,
            'component' => $event->getMetadata()?->getName() ?? $component::class,
            'default' => $this->normalizer->normalize($value),
            'allowed' => implode(', ', ColourPropsNormalizer::PLATFORM_MINIMUM),
        ]);
    }
}

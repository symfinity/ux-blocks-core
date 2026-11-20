<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocks\Registry\UxRoleRecord;
use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\UX\TwigComponent\ComponentAttributes;
use Symfony\UX\TwigComponent\Event\PreRenderEvent;

#[AsEventListener(event: PreRenderEvent::class, method: 'onPreRender')]
final class RoleAttributeBridgeListener
{
    /** @var array<string, string> */
    private array $componentAliases = [];

    public function __construct(
        private readonly UxRoleRegistry $registry,
        private readonly bool $fragmentIdsEnabled,
        private readonly ?FragmentInstanceCounter $fragmentCounter = null,
    ) {
    }

    public function aliasComponent(string $component, string $as): void
    {
        $this->componentAliases[$component] = $as;
    }

    public function onPreRender(PreRenderEvent $event): void
    {
        $name = $event->getMetadata()->getName();
        $record = $this->registry->findCoreByTwigComponent($this->componentAliases[$name] ?? $name);
        if (null === $record) {
            return;
        }

        $variables = $event->getVariables();
        $attributesVar = $event->getMetadata()->getAttributesVar();
        $attributes = $variables[$attributesVar] ?? null;
        if (!$attributes instanceof ComponentAttributes) {
            return;
        }

        $defaults = ['data-ui-role' => $record->role];
        if ($this->fragmentIdsEnabled) {
            $defaults['data-ui-fragment'] = $this->resolveFragmentId($record, $event->getComponent());
        }

        $variables[$attributesVar] = $attributes->defaults($defaults);
        $event->setVariables($variables);
    }

    private function resolveFragmentId(UxRoleRecord $record, object $component): string
    {
        if (property_exists($component, 'fragmentSuffix')) {
            $suffix = $component->fragmentSuffix ?? null;
            if (\is_string($suffix) && '' !== $suffix) {
                return $record->fragmentId . '.' . $suffix;
            }
        }

        $index = $this->fragmentCounter?->next($record->fragmentId) ?? 1;
        if ($index > 1) {
            return $record->fragmentId . '.' . $index;
        }

        return $record->fragmentId;
    }
}

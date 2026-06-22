<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\NormalizesButtonColourProps;
use Symfinity\UxBlocksCore\Twig\ResolvesExplicitIcon;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Link', template: '@UxBlocksCore/components/Link.html.twig')]
final class Link
{
    use NormalizesButtonColourProps;
    use ResolvesExplicitIcon;

    public string $href = '#';

    public string $variant = 'primary';

    public string $appearance = 'link';

    public bool $external = false;

    /** Ignored — position is locked per external vs internal rules. */
    public string $iconPosition = 'start';

    #[ExposeInTemplate('resolved_link_icon')]
    public function resolvedLinkIcon(): ?string
    {
        return $this->resolveExplicitIcon($this->external ? 'lucide:external-link' : null);
    }

    #[ExposeInTemplate('link_icon_position')]
    public function linkIconPosition(): ?string
    {
        if (null === $this->resolvedLinkIcon()) {
            return null;
        }

        return $this->external ? 'end' : 'start';
    }
}

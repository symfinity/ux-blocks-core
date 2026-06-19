<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ResolvesExplicitIcon;
use Symfinity\UxBlocksCore\Twig\ResolvesHeadingLevel;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('SectionHeading', template: '@UxBlocksCore/components/SectionHeading.html.twig')]
final class SectionHeading
{
    use ResolvesExplicitIcon;
    use ResolvesHeadingLevel;

    /** Ignored — locked start per icon-slots contract. */
    public string $iconPosition = 'end';

    public function __construct()
    {
        $this->level = 2;
    }

    #[ExposeInTemplate('resolved_heading_icon')]
    public function resolvedHeadingIcon(): ?string
    {
        return $this->resolveExplicitIcon();
    }
}

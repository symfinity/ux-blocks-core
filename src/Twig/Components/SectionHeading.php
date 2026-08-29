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

    /** Opt-in baseline rhythm scope — `baseline` emits {@code data-ui-rhythm="baseline"}. */
    public string $rhythm = '';

    public function __construct()
    {
        $this->level = 2;
    }

    #[ExposeInTemplate('resolved_heading_icon')]
    public function resolvedHeadingIcon(): ?string
    {
        return $this->resolveExplicitIcon();
    }

    #[ExposeInTemplate('rhythm_attr')]
    public function rhythmAttr(): string
    {
        return 'baseline' === $this->rhythm ? ' data-ui-rhythm="baseline"' : '';
    }

    #[ExposeInTemplate('root_tag')]
    public function rootTag(): string
    {
        return 1 === $this->headingLevel() ? 'header' : 'div';
    }
}

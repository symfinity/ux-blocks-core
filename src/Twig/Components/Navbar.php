<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ResolvesExplicitIcon;
use Symfinity\UxBlocksCore\Twig\ResolvesSurfaceSubstrate;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Navbar', template: '@UxBlocksCore/components/Navbar.html.twig')]
final class Navbar
{
    use ResolvesExplicitIcon;
    use ResolvesSurfaceSubstrate;

    /** Ignored — brand icon locked start. */
    public string $iconPosition = 'end';

    public function mount(): void
    {
        $this->mountSurfaceSubstrate();
    }

    #[ExposeInTemplate('resolved_brand_icon')]
    public function resolvedBrandIcon(): ?string
    {
        return $this->resolveExplicitIcon();
    }
}

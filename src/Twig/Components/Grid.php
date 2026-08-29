<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ResolvesContainerStyle;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Grid', template: '@UxBlocksCore/components/Grid.html.twig')]
final class Grid
{
    use ResolvesContainerStyle;

    public ?int $columns = null;

    public string $density = 'comfortable';

    public function mount(): void
    {
        $this->density = $this->normalizeDensity($this->density);
    }
}

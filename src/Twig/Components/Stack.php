<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ResolvesContainerStyle;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Stack', template: '@UxBlocksCore/components/Stack.html.twig')]
final class Stack
{
    use ResolvesContainerStyle;

    public string $direction = 'vertical';

    public string $gap = 'md';

    public string $density = 'comfortable';

    public function mount(): void
    {
        $this->density = $this->normalizeDensity($this->density);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ResolvesContainerStyle;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('Stack', template: '@UxBlocksCore/components/Stack.html.twig')]
final class Stack
{
    use ResolvesContainerStyle;

    private const DIRECTIONS = ['vertical', 'horizontal', 'inline'];

    /** `vertical` (column), `horizontal` (row from a 48rem container), `inline` (wrapping row at every width). */
    public string $direction = 'vertical';

    public string $gap = 'md';

    public string $density = 'comfortable';

    public function mount(): void
    {
        $this->density = $this->normalizeDensity($this->density);
    }

    #[PostMount]
    public function normalizeDirection(): void
    {
        if (!\in_array($this->direction, self::DIRECTIONS, true)) {
            $this->direction = 'vertical';
        }
    }
}

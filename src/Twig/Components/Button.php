<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\NormalizesControlSize;
use Symfinity\UxBlocksCore\Twig\NormalizesSemanticColourVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('Button', template: '@UxBlocksCore/components/Button.html.twig')]
final class Button
{
    use NormalizesSemanticColourVariant;
    use NormalizesControlSize;

    public string $variant = 'primary';

    public string $appearance = 'solid';

    public string $size = 'md';

    public string $as = 'button';

    public string $href = '#';

    public bool $disabled = false;

    public bool $loading = false;

    public bool $block = false;

    public ?string $icon = null;

    public string $iconPosition = 'start';

    public bool $iconDecorative = true;

    #[PostMount]
    public function syncButtonInteractionState(): void
    {
        if ($this->loading) {
            $this->disabled = true;
        }
    }
}

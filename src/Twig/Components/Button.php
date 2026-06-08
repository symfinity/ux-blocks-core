<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Button', template: '@UxBlocksCore/components/Button.html.twig')]
final class Button
{
    public string $variant = 'primary';

    public string $appearance = 'solid';

    public string $size = 'default';

    public string $as = 'button';

    public bool $disabled = false;

    public bool $block = false;
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Separator', template: '@UxBlocksCore/components/Separator.html.twig')]
final class Separator
{
    public string $orientation = 'horizontal';

    public bool $decorative = true;
}

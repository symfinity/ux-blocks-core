<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Figure', template: '@UxBlocksCore/components/Figure.html.twig')]
final class Figure
{
    public string $align = 'none';
}

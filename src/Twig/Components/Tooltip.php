<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Tooltip', template: '@UxBlocksCore/components/Tooltip.html.twig')]
final class Tooltip
{
    public string $label = '';

}
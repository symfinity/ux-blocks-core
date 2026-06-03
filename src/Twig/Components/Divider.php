<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Divider', template: '@UxBlocksCore/components/Divider.html.twig')]
final class Divider
{
    public string $variant = 'horizontal';

}
<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Grid', template: '@UxBlocksCore/components/Grid.html.twig')]
final class Grid
{
    public ?int $columns = null;
}

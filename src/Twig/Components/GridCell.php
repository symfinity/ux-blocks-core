<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Grid:Cell', template: '@UxBlocksCore/components/Grid/Cell.html.twig')]
final class GridCell
{
    public ?int $span = null;
}

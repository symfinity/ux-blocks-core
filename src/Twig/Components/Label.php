<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Label', template: '@UxBlocksCore/components/Label.html.twig')]
final class Label
{
    public ?string $for = null;
}

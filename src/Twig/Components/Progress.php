<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Progress', template: '@UxBlocksCore/components/Progress.html.twig')]
final class Progress
{
    public int $value = 0;

    public int $max = 100;

}
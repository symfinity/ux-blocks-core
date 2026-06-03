<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('AspectRatio', template: '@UxBlocksCore/components/AspectRatio.html.twig')]
final class AspectRatio
{
    public string $ratio = '16/9';

}
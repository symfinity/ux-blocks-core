<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Typography', template: '@UxBlocksCore/components/Typography.html.twig')]
final class Typography
{
    public string $variant = 'default';
}

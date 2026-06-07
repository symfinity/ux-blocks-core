<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Avatar', template: '@UxBlocksCore/components/Avatar.html.twig')]
final class Avatar
{
    public string $variant = '';

    public string $size = 'default';
}
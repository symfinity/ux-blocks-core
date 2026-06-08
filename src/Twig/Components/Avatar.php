<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Avatar', template: '@UxBlocksCore/components/Avatar.html.twig')]
final class Avatar
{
    use ExposesSemanticVariant;

    public string $variant = 'primary';

    public string $size = 'default';
}
<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Badge', template: '@UxBlocksCore/components/Badge.html.twig')]
final class Badge
{
    use ExposesSemanticVariant;

    public string $variant = 'primary';
}
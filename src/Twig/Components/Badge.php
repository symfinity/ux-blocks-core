<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Badge', template: '@UxBlocksCore/components/Badge.html.twig')]
final class Badge
{
    public string $variant = 'default';

}
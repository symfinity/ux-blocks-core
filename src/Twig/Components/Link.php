<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Link', template: '@UxBlocksCore/components/Link.html.twig')]
final class Link
{
    public string $href = '#';

    public string $variant = 'default';

}
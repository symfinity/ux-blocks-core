<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Image', template: '@UxBlocksCore/components/Image.html.twig')]
final class Image
{
    public string $src = '';

    public string $alt = '';

    public string $variant = 'fluid';

    public string $loading = 'lazy';
}

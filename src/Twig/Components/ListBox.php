<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('List', template: '@UxBlocksCore/components/List.html.twig')]
final class ListBox
{
    public string $variant = 'default';

    public string $gap = 'md';
}

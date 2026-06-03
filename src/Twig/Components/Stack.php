<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Stack', template: '@UxBlocksCore/components/Stack.html.twig')]
final class Stack
{
    public string $direction = 'vertical';

    public string $gap = 'md';
}

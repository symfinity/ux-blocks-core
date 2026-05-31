<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Card', template: '@UxBlocksCore/components/Card.html.twig')]
final class Card
{
    public string $size = 'default';
}

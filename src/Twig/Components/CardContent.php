<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Card:Content', template: '@UxBlocksCore/components/_shared/div_slot.html.twig')]
final class CardContent
{
}

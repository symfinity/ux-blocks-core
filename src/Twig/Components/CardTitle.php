<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Card:Title', template: '@UxBlocksCore/components/_shared/h3_slot.html.twig')]
final class CardTitle
{
}

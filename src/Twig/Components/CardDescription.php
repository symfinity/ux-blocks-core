<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Card:Description', template: '@UxBlocksCore/components/_shared/p_slot.html.twig')]
final class CardDescription
{
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Card:Header', template: '@UxBlocksCore/components/_shared/header_slot.html.twig')]
final class CardHeader
{
}

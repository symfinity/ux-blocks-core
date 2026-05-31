<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Table:Body', template: '@UxBlocksCore/components/_shared/tbody_slot.html.twig')]
final class TableBody
{
}

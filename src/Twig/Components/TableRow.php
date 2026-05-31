<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Table:Row', template: '@UxBlocksCore/components/_shared/tr_slot.html.twig')]
final class TableRow
{
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Table:Cell', template: '@UxBlocksCore/components/_shared/td_slot.html.twig')]
final class TableCell
{
}

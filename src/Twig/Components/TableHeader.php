<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Table:Header', template: '@UxBlocksCore/components/_shared/thead_slot.html.twig')]
final class TableHeader
{
}

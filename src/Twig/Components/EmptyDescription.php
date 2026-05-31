<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Empty:Description', template: '@UxBlocksCore/components/_shared/p_slot.html.twig')]
final class EmptyDescription
{
}

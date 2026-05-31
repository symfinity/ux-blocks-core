<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Checkbox', template: '@UxBlocksCore/components/Checkbox.html.twig')]
final class Checkbox
{
    public bool $checked = false;

    public bool $disabled = false;
}

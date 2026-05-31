<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('RadioGroup:Item', template: '@UxBlocksCore/components/RadioGroup/Item.html.twig')]
final class RadioGroupItem
{
    public string $value = '';

    public bool $disabled = false;
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Select', template: '@UxBlocksCore/components/Select.html.twig')]
final class Select
{
    public ?string $label = null;

    public ?string $placeholder = null;

    public string $size = 'default';

    public bool $invalid = false;

    public bool $disabled = false;
}

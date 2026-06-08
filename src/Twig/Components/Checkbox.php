<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Checkbox', template: '@UxBlocksCore/components/Checkbox.html.twig')]
final class Checkbox
{
    use ExposesSemanticVariant;

    public string $variant = 'primary';

    public bool $checked = false;

    public bool $disabled = false;
}

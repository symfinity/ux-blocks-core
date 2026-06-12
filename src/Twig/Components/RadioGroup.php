<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('RadioGroup', template: '@UxBlocksCore/components/RadioGroup.html.twig')]
final class RadioGroup
{
    public string $name = '';

    /** @var 'vertical'|'horizontal' */
    public string $orientation = 'vertical';
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Field', template: '@UxBlocksCore/components/Field.html.twig')]
final class Field
{
    public string $orientation = 'vertical';
}

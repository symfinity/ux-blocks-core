<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Input', template: '@UxBlocksCore/components/Input.html.twig')]
final class Input
{
    public string $type = 'text';

    public bool $invalid = false;

    public bool $disabled = false;
}

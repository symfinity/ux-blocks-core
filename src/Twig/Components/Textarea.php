<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Textarea', template: '@UxBlocksCore/components/Textarea.html.twig')]
final class Textarea
{
    public ?string $placeholder = null;

    public bool $invalid = false;

    public bool $disabled = false;
}

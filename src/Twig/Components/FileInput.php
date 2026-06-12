<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('FileInput', template: '@UxBlocksCore/components/FileInput.html.twig')]
final class FileInput
{
    public bool $invalid = false;

    public bool $disabled = false;
}

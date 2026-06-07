<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Spinner', template: '@UxBlocksCore/components/Spinner.html.twig')]
final class Spinner
{
    public string $size = 'md';

    public string $density = 'inline';

    public ?string $label = null;

    public bool $visible = true;
}

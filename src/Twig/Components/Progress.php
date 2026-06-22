<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfinity\UxBlocksCore\Twig\NormalizesSemanticColourVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Progress', template: '@UxBlocksCore/components/Progress.html.twig')]
final class Progress
{
    use ExposesSemanticVariant;
    use NormalizesSemanticColourVariant;

    public string $variant = 'primary';

    public int $value = 0;

    public int $max = 100;
}

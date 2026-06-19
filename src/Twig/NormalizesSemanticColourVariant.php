<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UiKernel\Token\ColourPropsNormalizer;
use Symfony\UX\TwigComponent\Attribute\PostMount;

/**
 * Maps legacy colour aliases (default, destructive, …) to graph canonical names before render.
 *
 * @property string $variant
 */
trait NormalizesSemanticColourVariant
{
    #[PostMount]
    public function normalizeSemanticColourVariant(): void
    {
        $this->variant = ColourPropsNormalizer::withBuiltInTheme()->normalize($this->variant);
    }
}

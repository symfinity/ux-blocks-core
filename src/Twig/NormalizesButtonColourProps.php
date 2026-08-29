<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocksCore\Contract\ForbiddenSemanticVariantEmission;
use Symfinity\UxBlocksCore\Token\ColourPropsNormalizer;
use Symfony\UX\TwigComponent\Attribute\PostMount;

/**
 * Maps legacy colour + appearance aliases to v2 vocabulary before render (115).
 *
 * @property string $variant
 * @property string $appearance
 */
trait NormalizesButtonColourProps
{
    #[PostMount]
    public function normalizeButtonColourProps(): void
    {
        $normalizer = new ColourPropsNormalizer();
        $normalized = $normalizer->normalizeButtonColour($this->variant, $this->appearance);
        $this->variant = $normalized['variant'];
        $this->appearance = $normalized['appearance'];
        ForbiddenSemanticVariantEmission::assertDomSafe($this->variant, static::class);
    }
}

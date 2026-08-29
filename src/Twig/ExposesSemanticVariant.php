<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

trait ExposesSemanticVariant
{
    #[ExposeInTemplate('semantic_variant')]
    public function semanticVariant(): string
    {
        /** @var string $variant */
        $variant = $this->variant;

        return $variant;
    }
}

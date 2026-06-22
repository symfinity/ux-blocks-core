<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocks\Registry\SurfaceSubstrate;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

/**
 * Opt-in {@code data-ui-surface} for allowlisted overlapping/floating roles (109).
 */
trait ResolvesSurfaceSubstrate
{
    public string $surface = 'solid';

    public function mountSurfaceSubstrate(): void
    {
        $this->surface = SurfaceSubstrate::normalize($this->surface);
    }

    #[ExposeInTemplate('surface_attr')]
    public function surfaceAttr(): string
    {
        return 'solid' === $this->surface ? '' : ' data-ui-surface="' . $this->surface . '"';
    }
}

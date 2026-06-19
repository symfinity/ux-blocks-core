<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfony\UX\TwigComponent\Attribute\PostMount;

/**
 * Maps legacy `default` size to canonical `md` before render.
 *
 * @property string $size
 */
trait NormalizesControlSize
{
    #[PostMount]
    public function normalizeControlSize(): void
    {
        if ('default' === $this->size) {
            $this->size = 'md';
        }
    }
}

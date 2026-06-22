<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

trait ResolvesIconWatermark
{
    public ?string $iconWatermark = null;

    public ?string $watermarkPosition = null;

    /** @var list<string> */
    private const WATERMARK_POSITIONS = [
        'top-start',
        'top-end',
        'bottom-start',
        'bottom-end',
        'center',
    ];

    protected function resolveIconWatermark(): ?string
    {
        if (null === $this->iconWatermark) {
            return null;
        }

        $name = trim($this->iconWatermark);

        return '' === $name ? null : $name;
    }

    protected function resolveWatermarkPosition(string $default): string
    {
        $position = $this->watermarkPosition ?? $default;

        return \in_array($position, self::WATERMARK_POSITIONS, true) ? $position : $default;
    }
}

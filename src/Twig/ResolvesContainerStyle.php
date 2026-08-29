<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

trait ResolvesContainerStyle
{
    protected function normalizeDensity(string $density): string
    {
        return match ($density) {
            'compact', 'comfortable', 'spacious' => $density,
            default => 'comfortable',
        };
    }

    protected function normalizeThemeVariant(string $themeVariant): string
    {
        return match ($themeVariant) {
            'default', 'muted', 'emphasis' => $themeVariant,
            default => 'default',
        };
    }
}

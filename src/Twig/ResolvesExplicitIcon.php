<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

trait ResolvesExplicitIcon
{
    public ?string $icon = null;

    public bool $iconDecorative = true;

    protected function resolveExplicitIcon(?string $default = null): ?string
    {
        if (null !== $this->icon) {
            return '' === $this->icon ? null : $this->icon;
        }

        return $default;
    }
}

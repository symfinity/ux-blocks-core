<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

trait ResolvesFeedbackVariantIcon
{
    public string $variant = 'info';

    public ?string $icon = null;

    public bool $iconDecorative = true;

    public function resolveFeedbackVariantIcon(): ?string
    {
        if (null !== $this->icon) {
            return '' === $this->icon ? null : $this->icon;
        }

        return match ($this->variant) {
            'success' => 'lucide:circle-check',
            'danger' => 'lucide:circle-x',
            'warning' => 'lucide:triangle-alert',
            'info' => 'lucide:info',
            default => null,
        };
    }
}

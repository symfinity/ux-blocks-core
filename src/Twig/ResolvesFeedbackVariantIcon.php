<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

/**
 * Feedback-role variant default icons (flash, alert, toast).
 *
 * @property string $variant
 * @property string|null $icon
 */
trait ResolvesFeedbackVariantIcon
{
    public string $variant = 'info';

    public ?string $icon = null;

    public bool $iconDecorative = true;

    protected function resolveFeedbackVariantIcon(): ?string
    {
        if (null !== $this->icon) {
            return '' === $this->icon ? null : $this->icon;
        }

        return match ($this->variant) {
            'success' => 'lucide:circle-check',
            'error', 'destructive' => 'lucide:circle-x',
            'warning' => 'lucide:triangle-alert',
            'info' => 'lucide:info',
            default => null,
        };
    }
}

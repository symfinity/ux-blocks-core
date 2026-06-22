<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Media', template: '@UxBlocksCore/components/Media.html.twig')]
final class Media
{
    /** shadcn EmptyMedia parity: {@code default} slot for avatar/custom; {@code icon} for glyph well. */
    public string $variant = 'default';

    public ?string $icon = null;

    private bool $iconDecorative = true;

    public function mount(): void
    {
        $this->variant = match ($this->variant) {
            'default', 'icon' => $this->variant,
            default => 'default',
        };
    }

    #[ExposeInTemplate('iconDecorative')]
    public function isIconDecorative(): bool
    {
        return $this->iconDecorative;
    }

    #[ExposeInTemplate('resolved_media_icon')]
    public function resolvedMediaIcon(): ?string
    {
        if (null !== $this->icon) {
            return '' === $this->icon ? null : $this->icon;
        }

        return null;
    }
}

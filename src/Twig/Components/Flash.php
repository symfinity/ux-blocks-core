<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Flash', template: '@UxBlocksCore/components/Flash.html.twig')]
final class Flash
{
    use ExposesSemanticVariant;

    public string $variant = 'info';

    public string $placement = 'top';

    /** Seconds until auto-dismiss; null uses variant default (5s non-error, persist on error). */
    public ?int $dismissAfter = null;

    public ?string $icon = null;

    public bool $iconDecorative = true;

    #[ExposeInTemplate('flash_aria_role')]
    public function flashAriaRole(): string
    {
        return \in_array($this->variant, ['error', 'destructive'], true) ? 'alert' : 'status';
    }

    #[ExposeInTemplate('auto_dismiss')]
    public function autoDismiss(): bool
    {
        return null !== $this->resolvedDismissAfterSeconds();
    }

    #[ExposeInTemplate('flash_duration_css')]
    public function flashDurationCss(): ?string
    {
        $seconds = $this->resolvedDismissAfterSeconds();

        return null === $seconds ? null : sprintf('%ds', $seconds);
    }

    #[ExposeInTemplate('resolved_icon')]
    public function resolvedIcon(): ?string
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

    private function resolvedDismissAfterSeconds(): ?int
    {
        if (null !== $this->dismissAfter) {
            return $this->dismissAfter > 0 ? $this->dismissAfter : null;
        }

        if (\in_array($this->variant, ['error', 'destructive'], true)) {
            return null;
        }

        return 5;
    }
}

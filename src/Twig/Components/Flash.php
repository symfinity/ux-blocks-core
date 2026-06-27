<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfinity\UxBlocksCore\Twig\NormalizesSemanticColourVariant;
use Symfinity\UxBlocksCore\Twig\ResolvesFeedbackVariantIcon;
use Symfinity\UxBlocksCore\Twig\ResolvesIconWatermark;
use Symfinity\UxBlocksCore\Twig\ResolvesSurfaceSubstrate;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Flash', template: '@UxBlocksCore/components/Flash.html.twig')]
final class Flash
{
    use ExposesSemanticVariant;
    use NormalizesSemanticColourVariant;
    use ResolvesFeedbackVariantIcon;
    use ResolvesIconWatermark;
    use ResolvesSurfaceSubstrate;

    public string $placement = 'top';

    /** Seconds until auto-dismiss; null uses variant default (5s non-error, persist on error). */
    public ?int $dismissAfter = null;

    public function mount(): void
    {
        $this->mountSurfaceSubstrate();
    }

    #[ExposeInTemplate('flash_aria_role')]
    public function flashAriaRole(): string
    {
        return \in_array($this->variant, ['danger'], true) ? 'alert' : 'status';
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
        return $this->resolveFeedbackVariantIcon();
    }

    #[ExposeInTemplate('resolved_icon_watermark')]
    public function resolvedIconWatermark(): ?string
    {
        return $this->resolveIconWatermark();
    }

    #[ExposeInTemplate('resolved_watermark_position')]
    public function resolvedWatermarkPosition(): string
    {
        return $this->resolveWatermarkPosition('top-end');
    }

    private function resolvedDismissAfterSeconds(): ?int
    {
        if (null !== $this->dismissAfter) {
            return $this->dismissAfter > 0 ? $this->dismissAfter : null;
        }

        if ('danger' === $this->variant) {
            return null;
        }

        return 5;
    }
}

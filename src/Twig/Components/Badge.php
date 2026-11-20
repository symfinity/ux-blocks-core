<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UxBlocksCore\Twig\ExposesSemanticVariant;
use Symfinity\UxBlocksCore\Twig\NormalizesControlSize;
use Symfinity\UxBlocksCore\Twig\NormalizesButtonColourProps;
use Symfinity\UxBlocksCore\Twig\ResolvesExplicitIcon;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('Badge', template: '@UxBlocksCore/components/Badge.html.twig')]
final class Badge
{
    use ExposesSemanticVariant;
    use NormalizesButtonColourProps;
    use NormalizesControlSize;
    use ResolvesExplicitIcon;

    public string $variant = 'primary';

    /** `solid` or `outline`; `variant="outline"` is a shortcut for primary + outline. */
    public string $appearance = 'solid';

    public string $size = 'md';

    /** Ignored — badge icon position is locked to start. */
    public string $iconPosition = 'end';

    #[ExposeInTemplate('resolved_badge_icon')]
    public function resolvedBadgeIcon(): ?string
    {
        return $this->resolveExplicitIcon();
    }
}

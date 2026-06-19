<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfinity\UiKernel\Token\ColourPropsNormalizer;
use Symfinity\UxBlocksCore\Twig\ResolvesExplicitIcon;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsTwigComponent('Input', template: '@UxBlocksCore/components/Input.html.twig')]
final class Input
{
    use ResolvesExplicitIcon;

    public string $type = 'text';

    public string $variant = '';

    public ?string $value = null;

    public ?string $placeholder = null;

    public bool $invalid = false;

    public bool $disabled = false;

    public string $iconPosition = 'start';

    #[PostMount]
    public function syncInputValidationVariant(): void
    {
        if ('' === $this->variant && $this->invalid) {
            $this->variant = 'danger';
        }

        if ('' !== $this->variant) {
            $this->variant = ColourPropsNormalizer::withBuiltInTheme()->normalize($this->variant);
        }
    }

    #[ExposeInTemplate('resolved_input_icon')]
    public function resolvedInputIcon(): ?string
    {
        return $this->resolveExplicitIcon();
    }

    #[ExposeInTemplate('input_icon_position')]
    public function inputIconPosition(): string
    {
        return \in_array($this->iconPosition, ['start', 'end'], true) ? $this->iconPosition : 'start';
    }
}

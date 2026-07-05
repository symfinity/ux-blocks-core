<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class UxBlocksUiAssetsExtension extends AbstractExtension
{
    public function __construct(
        private readonly UxBlocksUiAssetsRenderer $uiAssetsRenderer,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ux_blocks_ui_assets', $this->uiAssetsRenderer->renderInlineStylesOnce(...), ['is_safe' => ['html']]),
        ];
    }
}

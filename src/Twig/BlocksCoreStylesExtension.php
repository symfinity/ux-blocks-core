<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocksCore\Css\BlocksCoreCssProvider;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class BlocksCoreStylesExtension extends AbstractExtension
{
    public function __construct(
        private readonly BlocksCoreCssProvider $cssProvider,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ux_blocks_core_stylesheet', $this->cssProvider->stylesheet(...), ['is_safe' => ['html']]),
        ];
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocksCore\Showcase\CatalogComponentRenderer;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class CatalogComponentExtension extends AbstractExtension
{
    public function __construct(
        private readonly CatalogComponentRenderer $catalogComponentRenderer,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'ux_blocks_catalog_component',
                $this->renderCatalogComponent(...),
                ['is_safe' => ['html']],
            ),
        ];
    }

    /**
     * @param array<string, mixed> $props
     */
    public function renderCatalogComponent(
        string $twigName,
        array $props = [],
        ?string $slotText = null,
        bool $hasSlot = false,
    ): string {
        return $this->catalogComponentRenderer->render($twigName, $props, $slotText, $hasSlot);
    }
}

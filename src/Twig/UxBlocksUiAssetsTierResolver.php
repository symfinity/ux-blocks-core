<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

/**
 * Maps ux-blocks fragment ids to ordered inline CSS tier keys.
 */
final class UxBlocksUiAssetsTierResolver
{
    /**
     * @return list<string> tier keys: core, form, extended, interactive, marketing, ecommerce
     */
    public function resolveForFragmentId(string $fragmentId): array
    {
        if (str_starts_with($fragmentId, 'blocks.shop.')) {
            return ['core', 'marketing', 'ecommerce'];
        }

        if (str_starts_with($fragmentId, 'blocks.marketing.')) {
            return ['core', 'marketing'];
        }

        if (str_starts_with($fragmentId, 'blocks.live.')) {
            return ['core', 'form', 'extended', 'interactive'];
        }

        if (str_starts_with($fragmentId, 'blocks.int.')) {
            return ['core', 'form', 'extended', 'interactive'];
        }

        if (str_starts_with($fragmentId, 'blocks.ext.')) {
            return ['core', 'form', 'extended'];
        }

        if (str_starts_with($fragmentId, 'blocks.form.')) {
            return ['core', 'form'];
        }

        if (str_starts_with($fragmentId, 'blocks.core.')) {
            return ['core'];
        }

        return ['core'];
    }
}

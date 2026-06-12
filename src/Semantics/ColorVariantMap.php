<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Semantics;

use Symfinity\UiKernel\Token\SemanticVariant;

/**
 * Maps semantic colour variants to canonical {@code --ui-color-*} token keys (018, 060).
 */
final class ColorVariantMap
{
    /** @var list<string> */
    public const SEMANTIC_VARIANTS = SemanticVariant::ALL;

    public static function semanticTokenKey(string $variant): string
    {
        return SemanticVariant::tokenKey($variant);
    }

    /**
     * @return array<string, list<string>> canonical semantic variant => data-ui-variant attribute values
     */
    public static function cssVariantSelectors(): array
    {
        $selectors = [];
        foreach (SemanticVariant::ALL as $variant) {
            $selectors[$variant] = [$variant];
        }

        return $selectors;
    }
}

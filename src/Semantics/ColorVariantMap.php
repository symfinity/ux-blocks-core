<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Semantics;

use Symfinity\UiKernel\Token\ColourPropsNormalizer;
use Symfinity\UiKernel\Token\SemanticColourVocabulary;

/**
 * Maps semantic colour variants to canonical {@code --ui-color-*} token keys (018, 060, 077).
 */
final class ColorVariantMap
{
    /** @var list<string> */
    public const SEMANTIC_VARIANTS = SemanticColourVocabulary::PLATFORM_MINIMUM;

    public static function semanticTokenKey(string $variant): string
    {
        return ColourPropsNormalizer::tokenKey($variant);
    }

    /**
     * @return array<string, list<string>> canonical semantic variant => data-ui-variant attribute values
     */
    public static function cssVariantSelectors(): array
    {
        $selectors = [];
        foreach (self::SEMANTIC_VARIANTS as $variant) {
            $selectors[$variant] = [$variant];
        }

        return $selectors;
    }
}

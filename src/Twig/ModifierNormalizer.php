<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfinity\UxBlocks\Registry\CompositionLanguage;

/**
 * Centralized normalization for the modifier lexicon (symfinity 108).
 *
 * One implementation of the size/density/appearance/state rules referenced by the
 * SDK {@see CompositionLanguage}; components delegate here instead of re-deriving
 * canonical values per class.
 */
final class ModifierNormalizer
{
    /**
     * Map the legacy `default` token to the canonical `md`; other values pass through
     * (non-coercing — preserves existing accepted tokens).
     */
    public static function canonicalSize(string $size): string
    {
        return 'default' === $size ? CompositionLanguage::SIZE_CANONICAL_DEFAULT : $size;
    }

    /**
     * Strict size: coerce anything outside the lexicon set to the canonical default.
     */
    public static function size(string $size): string
    {
        $size = self::canonicalSize($size);
        $set = CompositionLanguage::tokenSet('size') ?? [];

        return \in_array($size, $set, true) ? $size : CompositionLanguage::SIZE_CANONICAL_DEFAULT;
    }

    public static function density(string $density, string $default = 'comfortable'): string
    {
        return \in_array($density, CompositionLanguage::MODIFIER_LEXICON['density'], true) ? $density : $default;
    }

    public static function appearance(string $appearance, string $default = 'solid'): string
    {
        return \in_array($appearance, CompositionLanguage::MODIFIER_LEXICON['appearance'], true) ? $appearance : $default;
    }

    /**
     * Normalize a state-flag value (bool, "true"/"false", "1"/"0") to a boolean.
     */
    public static function stateFlag(mixed $value): bool
    {
        if (\is_bool($value)) {
            return $value;
        }

        return (bool) filter_var($value, \FILTER_VALIDATE_BOOLEAN);
    }
}

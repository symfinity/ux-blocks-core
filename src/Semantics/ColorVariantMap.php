<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Semantics;

use Symfinity\UxBlocksCore\Token\ColourPropsNormalizer;

/**
 * Maps semantic colour variants to canonical {@code --ui-color-*} token keys (115).
 */
final class ColorVariantMap
{
    /** @var list<string> */
    public const SEMANTIC_VARIANTS = ColourPropsNormalizer::PLATFORM_MINIMUM;

    /** @var list<string> */
    private const ALIASES = [
        'error',
        'destructive',
    ];

    public static function semanticTokenKey(string $variant): string
    {
        if (!\in_array($variant, [...self::SEMANTIC_VARIANTS, ...self::ALIASES], true)) {
            throw new \InvalidArgumentException(sprintf('Unknown semantic colour variant "%s".', $variant));
        }

        $tokenVariant = match ($variant) {
            'destructive', 'error' => 'danger',
            default => $variant,
        };

        return ColourPropsNormalizer::tokenKey($tokenVariant);
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

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Token;

/**
 * Platform semantic colour normalization (115) without graph bootstrap.
 *
 * Split-mirror CI may resolve an older {@see \Symfinity\UiKernel\Token\ColourPropsNormalizer}
 * that lacks {@code normalizeButtonColour}; core ships this copy so Twig components stay
 * compatible with {@code symfinity/ui-kernel ^0.1}.
 */
final class ColourPropsNormalizer
{
    /** @var list<string> */
    public const PLATFORM_MINIMUM = [
        'primary',
        'secondary',
        'accent',
        'success',
        'danger',
        'info',
        'warning',
        'neutral',
    ];

    /** @var array<string, string> */
    private const LEGACY_ALIASES = [
        '' => 'primary',
        'default' => 'primary',
        'destructive' => 'danger',
        'error' => 'danger',
        'tertiary' => 'accent',
        'ghost' => 'neutral',
    ];

    /** @var list<string> */
    private const APPEARANCE_VARIANT_ALIASES = ['outline', 'link'];

    public static function tokenKey(string $variant): string
    {
        return '--ui-color-' . $variant;
    }

    public function normalize(string $value): string
    {
        $candidate = self::LEGACY_ALIASES[$value] ?? $value;

        if (\in_array($candidate, self::APPEARANCE_VARIANT_ALIASES, true)) {
            return 'primary';
        }

        if (\in_array($candidate, self::PLATFORM_MINIMUM, true)) {
            return $candidate;
        }

        return 'primary';
    }

    /**
     * @return array{variant: string, appearance: string}
     */
    public function normalizeButtonColour(string $variant, string $appearance): array
    {
        $candidate = self::LEGACY_ALIASES[$variant] ?? $variant;

        if (\in_array($candidate, self::APPEARANCE_VARIANT_ALIASES, true)) {
            return [
                'variant' => 'primary',
                'appearance' => $candidate,
            ];
        }

        if ($variant === 'ghost') {
            if ($appearance !== 'solid') {
                return [
                    'variant' => 'neutral',
                    'appearance' => $appearance,
                ];
            }

            return [
                'variant' => 'neutral',
                'appearance' => 'ghost',
            ];
        }

        return [
            'variant' => $this->normalize($variant),
            'appearance' => $appearance,
        ];
    }
}

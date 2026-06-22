<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Contract;

/**
 * **091 / 060** — values that MUST NOT appear on {@code data-ui-variant} after normalization.
 *
 * Legacy author aliases ({@see \Symfinity\UiKernel\Token\ColourPropsNormalizer}) are mapped at
 * PostMount; emitting these on the DOM is always a defect.
 */
final class ForbiddenSemanticVariantEmission
{
    /** @var list<string> */
    public const DOM_FORBIDDEN = ['', 'default', 'destructive', 'error'];

    /** @var list<string> Kiosk / catalog YAML props.variant — use canonical names only. */
    public const KIOSK_PROP_FORBIDDEN = ['', 'destructive', 'error'];

    /** @var list<string> Demo cell ids — must not mimic forbidden semantic tokens. */
    public const KIOSK_DEMO_ID_PREFIX_FORBIDDEN = ['destructive', 'error'];

    public static function isForbiddenDomValue(string $variant): bool
    {
        return \in_array($variant, self::DOM_FORBIDDEN, true);
    }

    public static function isForbiddenKioskPropValue(string $variant): bool
    {
        return \in_array($variant, self::KIOSK_PROP_FORBIDDEN, true);
    }

    public static function isForbiddenKioskDemoId(string $demoId): bool
    {
        if ($demoId === '') {
            return true;
        }

        foreach (self::KIOSK_DEMO_ID_PREFIX_FORBIDDEN as $prefix) {
            if ($demoId === $prefix || str_starts_with($demoId, $prefix . '-')) {
                return true;
            }
        }

        return false;
    }

    public static function assertDomSafe(string $variant, string $context = 'component'): void
    {
        if (self::isForbiddenDomValue($variant)) {
            throw new \InvalidArgumentException(sprintf(
                'Forbidden data-ui-variant emission "%s" from %s — use **060** canonical names (danger not destructive).',
                $variant === '' ? '(empty)' : $variant,
                $context,
            ));
        }
    }

    public static function assertKioskPropSafe(string $variant, string $context): void
    {
        if (self::isForbiddenKioskPropValue($variant)) {
            throw new \InvalidArgumentException(sprintf(
                'Forbidden kiosk props.variant "%s" in %s — use canonical **060** names (danger, primary, …).',
                $variant === '' ? '(empty)' : $variant,
                $context,
            ));
        }
    }

    public static function assertKioskDemoIdSafe(string $demoId, string $context): void
    {
        if (self::isForbiddenKioskDemoId($demoId)) {
            throw new \InvalidArgumentException(sprintf(
                'Forbidden kiosk demo id "%s" in %s — use neutral ids (danger-title, not destructive-title).',
                $demoId,
                $context,
            ));
        }
    }
}

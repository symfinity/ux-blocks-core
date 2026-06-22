<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Support;

/**
 * Normalizes dart-sass unquoted attribute selectors for PHPUnit string assertions.
 */
final class RoleCssAssert
{
    public static function normalize(string $css): string
    {
        $css = (string) preg_replace(
            '/\[(data-ui-[a-z-]+)=([a-z0-9._-]+)\]/',
            '[$1="$2"]',
            $css,
        );

        $css = (string) preg_replace(
            '/\[(aria-current)=([a-z]+)\]/',
            '[$1="$2"]',
            $css,
        );

        return $css;
    }
}

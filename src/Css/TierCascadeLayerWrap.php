<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Css;

/**
 * Wraps tier role CSS in the Chameleon {@code blocks.core} cascade layer without requiring ui-kernel.
 */
final class TierCascadeLayerWrap
{
    public const BLOCKS_CORE = 'blocks.core';

    public static function wrap(string $layerName, string $css): string
    {
        $css = trim($css);
        if ($css === '') {
            return '';
        }

        if (str_starts_with(ltrim($css), "@layer {$layerName}")) {
            return $css;
        }

        return "@layer {$layerName} {\n{$css}\n}";
    }
}

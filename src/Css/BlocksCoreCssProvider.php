<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Css;

/**
 * Inline role CSS for workshop previews and hosts without AssetMapper link tags.
 * Themed apps SHOULD load {@see assetPath()} via AssetMapper after kernel tokens.
 */
final class BlocksCoreCssProvider
{
    public function __construct(
        private readonly string $packageDir,
    ) {
    }

    public function assetPath(): string
    {
        return 'ux-blocks-core/styles/blocks-core.css';
    }

    public function stylesheet(): string
    {
        $bundle = $this->packageDir . '/assets/styles/roles/_bundle.css';
        if (!is_readable($bundle)) {
            return '';
        }

        return (string) file_get_contents($bundle);
    }
}

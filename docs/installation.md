# Installation

## Prerequisites

1. Add the [symfinity/recipes](https://github.com/symfinity/recipes) Flex endpoint to your project's `composer.json` (see [recipes README](https://github.com/symfinity/recipes/blob/main/README.md)).
2. Install **ui-kernel** (theme CSS) and **ux-blocks** (registry schema) — required peers for this package.

```bash
composer require symfinity/ui-kernel symfinity/ux-blocks
```

## Composer

```bash
composer require symfinity/ux-blocks-core
```

## Symfony Flex

The `0.1` recipe applies:

- Registers `SymfinityUxBlocksCoreBundle` for **all** environments
- No app config file is copied — the bundle auto-configures AssetMapper, Twig paths, and UX Twig components

Composer also resolves `symfinity/ui-kernel` and `symfinity/ux-blocks` when they are not already present.

## Manual installation

When Flex is unavailable:

1. `composer require symfinity/ui-kernel symfinity/ux-blocks symfinity/ux-blocks-core`
2. Register `Symfinity\UxBlocksCore\SymfinityUxBlocksCoreBundle` in `config/bundles.php` for the environments you need
3. Ensure AssetMapper and UX Twig Component bundles are enabled (same as a standard Symfony UX app)

## Verify installation

```bash
php bin/console debug:container --tag=twig.component | grep -i uxblocks
php bin/console debug:router ux_blocks_core_catalog
```

The catalog route is optional dev tooling at `/ux-blocks-core/catalog`.

## Next steps

[Quick start](quickstart.md).

# Upgrade guide

## First public release (`v0.1.0`)

This is the first tagged release on Packagist. There is no migration from a prior semver line.

### Install

```bash
composer require symfinity/ux-blocks:^0.1 symfinity/ux-blocks-core:^0.1
# optional themed app:
composer require symfinity/ui-kernel:^0.1
```

Ensure the [symfinity/recipes](https://github.com/symfinity/recipes) Flex endpoint is configured so the install recipe runs.

### What you get

- Symfony bundle registered for all environments
- **25** atomic UX Twig component roles with `blocks.*` fragment ids
- Registry revision **1.4** in package `config/ux_roles.yaml`
- AssetMapper + Twig + UX Twig Component auto-configuration

### After install

1. Include ui-kernel head partial in your base layout — [Quick start](quickstart.md)
2. Replace any local copies of core role templates with `<twig:*>` components
3. Clear Symfony cache in each environment

## 0.1.2

Patch release after [v0.1.0](https://github.com/symfinity/ux-blocks-core/releases/tag/v0.1.0). Role CSS refresh only — no Twig or registry API changes.

```bash
composer update symfinity/ux-blocks-core
```

After upgrade:

1. Clear Symfony cache and hard-refresh the browser if AssetMapper serves cached CSS in dev.
2. Re-check visual baselines for `tabs`, `dialog`, `filter-bar`, and form-adjacent roles if you snapshot CSS output.

## 0.1.3

Adds `ResolvesFeedbackVariantIcon` for shared feedback-variant icon defaults. Required by `symfinity/ux-blocks-interactive` **^0.1** when using toast icon resolution.

```bash
composer update symfinity/ux-blocks-core
```

After upgrade:

1. Clear Symfony cache in each environment.
2. If you extend core Twig components, you may `use Symfinity\UxBlocksCore\Twig\ResolvesFeedbackVariantIcon` instead of copying variant→icon `match` logic.

## 0.1.4

Flash role CSS fix — `<twig:Flash variant="danger">` now applies `--ui-color-danger` correctly.

```bash
composer update symfinity/ux-blocks-core
```

After upgrade:

1. Clear Symfony cache in each environment.
2. Hard-refresh the browser in dev if AssetMapper serves cached CSS.

## 0.1.5

Maintenance release — sponsorship metadata and split-mirror CI reliability. No Twig, registry, or role CSS changes.

```bash
composer update symfinity/ux-blocks-core
```

No config or template changes required after upgrade.

## 0.1.6

Adds automatic inline tier CSS when UX Twig components render — no manual layout wiring for clean-app installs without ui-kernel.

```bash
composer update symfinity/ux-blocks-core
```

After upgrade:

1. Clear Symfony cache in each environment.
2. If you already call `ux_blocks_ui_assets()` in layout, behaviour is unchanged (subscriber skips when style ids exist).
3. If you rely on ui-kernel only, no action required — kernel CSS path is unchanged.
4. Hard-refresh the browser in dev if AssetMapper serves cached CSS after the `@layer blocks.core` wrap.

Optional: remove redundant manual tier stylesheet calls from layouts now covered by auto-inject.

## 0.1.7

`<twig:Navbar>` is a core component (`blocks.navbar`). `blocks.ext.navbar` still resolves until the next minor.

Stack accepts `direction="inline"`. Badge accepts `appearance="outline"`, and `variant="outline"` means primary plus outline.

Inline tier styles are injected into full pages only (a response with `<head>`). Live re-renders and other fragments do not receive them. A tier that first appears inside a Live re-render can be listed in `symfinity_ux_blocks_core.ui_assets.always_tiers` (default `[]`).

`UxRoleRegistry` now takes a list of catalogue paths (`$yamlPaths`) instead of one path string. It reads every installed tier, core first. Role attributes on Twig components still come from the core catalogue only.

The package requires `psr/log`. An unknown colour name still falls back to the default and logs one warning when a logger is available.

```bash
composer update symfinity/ux-blocks-core
```

After upgrade, clear the Symfony cache. Templates that constructed `UxRoleRegistry` with a single path string must pass a list.

## 0.1.8

This package now requires `symfinity/ux-blocks` `^0.1.7`.

A section heading with actions wraps onto the next line when the page is narrow. Level 1 spacing, icon size, and title size follow the heading the template renders. The larger title size still applies when the theme does not define those font tokens.

```bash
composer update symfinity/ux-blocks-core symfinity/ux-blocks
```

After upgrade, hard-refresh the browser in dev if AssetMapper serves cached section-heading CSS.

## Future releases

See [CHANGELOG](https://github.com/symfinity/ux-blocks-core/blob/main/CHANGELOG.md) for version-to-version notes.

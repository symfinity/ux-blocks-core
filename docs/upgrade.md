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

## Future releases

See [CHANGELOG](https://github.com/symfinity/ux-blocks-core/blob/main/CHANGELOG.md) for version-to-version notes.

# Upgrade guide

## First public release (`v0.1.0`)

This is the first tagged release on Packagist and the read-only split mirror. There is no migration from a prior semver line.

### Install

```bash
composer require symfinity/ui-kernel:^0.1 symfinity/ux-blocks:^0.1 symfinity/ux-blocks-core:^0.1
```

Ensure the [symfinity/recipes](https://github.com/symfinity/recipes) Flex endpoint is configured so the install recipe runs.

### What you get

- Symfony bundle registered for all environments
- **24** atomic UX Twig component roles with `blocks.*` fragment ids
- Registry revision **1.4** in package `config/ux_roles.yaml`
- AssetMapper + Twig + UX Twig Component auto-configuration
- Optional dev catalog at `/ux-blocks-core/catalog`

### Breaking changes from monorepo `main` (pre-tag)

If you tracked `dev-main` before `v0.1.0`:

- Composer alias is `0.1.x-dev` (was `1.x-dev`)
- Public dependencies use `symfinity/ui-kernel` and `symfinity/ux-blocks` at `^0.1` (not `@dev` path repos)
- Role CSS lives in this package — ui-kernel emits theme tokens only

### After upgrading

1. Include ui-kernel head partial in your base layout — [Quick start](quickstart.md)
2. Replace any local copies of core role templates with `<twig:*>` components
3. Clear Symfony cache in each environment

## Future releases

See [CHANGELOG.md](../CHANGELOG.md) for version-to-version notes.

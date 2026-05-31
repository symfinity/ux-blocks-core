# symfinity/ux-blocks-core

Chameleon UX Blocks Core — fourteen v0 Symfony UX Twig components with registry-aligned `data-ui-role` / `data-ui-fragment` markup.

**Family:** [PRODUCT-ux-blocks-family](../../../classified/explore/PRODUCT-ux-blocks-family.md)

**Feature:** [symfinity 003 — ux-component-catalog](../../../specs/symfinity/symfinity/3-ux-component-catalog/spec.md)

## Install

```bash
composer require symfinity/ux-blocks-core
```

Requires Symfony **7.4+**, `symfinity/ux-blocks`, `symfony/ux-twig-component` ^2, `symfony/stimulus-bundle` ^2. Does **not** require `symfony/ux-toolkit`.

Register the bundle:

```php
// config/bundles.php
Symfinity\UxBlocksCore\SymfinityUxBlocksCoreBundle::class => ['all' => true],
```

## Usage

```twig
<twig:Button variant="default">Save</twig:Button>

<twig:Field orientation="vertical">
    <twig:Field:Label for="email">Email</twig:Field:Label>
    <twig:Input id="email" name="email" />
</twig:Field>
```

Fragment ids use prefix `blocks` (e.g. `blocks.button`). Full table: [role-registry contract](../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/role-registry.md).

## Catalog (dev/test)

`GET /ux-blocks-core/catalog` — static demo of all fourteen v0 roles.

## v0 roles

`button`, `separator`, `typography`, `card`, `empty`, `table`, `alert`, `label`, `input`, `textarea`, `select`, `field`, `checkbox`, `radio-group`

## Docs

- [architecture.md](docs/architecture.md) — stage A, kernel CSS boundary
- [porting.md](docs/porting.md) — REF checkout from symfony/ux-toolkit shadcn kit

## Extension

Add a row to the [role-registry contract](../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/role-registry.md) and mirror it in `config/ux_roles.yaml` before shipping a new component.

## Test

From product monorepo root:

```bash
cd src/symfinity
make test
# or per-package:
docker compose --env-file .env.docker run --rm -T -w /app/packages/ux-blocks-core php php vendor/bin/phpunit
```

Local package dir (after `composer install` in `packages/ux-blocks-core/`):

```bash
composer test
```

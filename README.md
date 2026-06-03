# symfinity/ux-blocks-core

Chameleon UX Blocks Core — **48** Symfony UX Twig components with registry-aligned `data-ui-role` / `data-ui-fragment` markup (fourteen v0 + thirty-four v1).

**Family:** [PRODUCT-ux-blocks-family](../../../classified/explore/PRODUCT-ux-blocks-family.md)

**Planning:** symfinity **024** `DONE` 2026-06-03

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

<twig:Dialog>
    <p>Confirm action</p>
</twig:Dialog>
```

Fragment ids use prefix `blocks` (e.g. `blocks.dialog`). Registry: [core-v1-role-registry](../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/core-v1-role-registry.md).

## Interaction profile

This package is **V1** atomic primitives for Chameleon / UI Kernel.

| Token | Used in core V1 |
|-------|-----------------|
| `nat` | All roles — native HTML + kernel `[data-ui-role]` CSS |
| `act` | `pagination`, `dashboard-shell` (optional declarative actions) |
| `stl` | **Not** shipped by default — see `symfinity/ux-blocks-extended` (**025**) |
| `live` | **Not** in core — see `symfinity/ux-blocks-lab` (**028**) |

**Headless:** `composer require symfinity/ux-blocks-core` does not require `symfinity/ui-kernel`.

**Fragments:** default prefix `blocks` (e.g. `blocks.dialog`).

## Components

| Role | Twig | Category | Interaction | Fragment | Status | REF |
|------|------|----------|-------------|----------|--------|-----|
| `button` | `Button` | Actions | nat, act | `blocks.button` | shipped | shadcn |
| `separator` | `Separator` | Layout | nat | `blocks.separator` | shipped | shadcn |
| `typography` | `Typography` | Typography | nat | `blocks.typography` | shipped | shadcn |
| `card` | `Card` | Layout | nat | `blocks.card` | shipped | shadcn |
| `empty` | `Empty` | Feedback | nat | `blocks.empty` | shipped | shadcn |
| `table` | `Table` | Data display | nat | `blocks.table` | shipped | shadcn |
| `alert` | `Alert` | Feedback | nat | `blocks.alert` | shipped | shadcn |
| `label` | `Label` | Forms | nat | `blocks.label` | shipped | shadcn |
| `input` | `Input` | Forms | nat | `blocks.input` | shipped | shadcn |
| `textarea` | `Textarea` | Forms | nat | `blocks.textarea` | shipped | shadcn |
| `select` | `Select` | Forms | nat | `blocks.select` | shipped | shadcn |
| `field` | `Field` | Forms | nat | `blocks.field` | shipped | shadcn |
| `checkbox` | `Checkbox` | Forms | nat | `blocks.checkbox` | shipped | shadcn |
| `radio-group` | `RadioGroup` | Forms | nat | `blocks.radio-group` | shipped | shadcn |
| `grid` | `Grid` | Layout | nat | `blocks.grid` | shipped | shadcn |
| `stack` | `Stack` | Layout | nat | `blocks.stack` | shipped | shadcn / DaisyUI |
| `scroll-area` | `ScrollArea` | Layout | nat | `blocks.scroll-area` | shipped | overflow CSS |
| `aspect-ratio` | `AspectRatio` | Layout | nat | `blocks.aspect-ratio` | shipped | shadcn |
| `divider` | `Divider` | Layout | nat | `blocks.divider` | shipped | DaisyUI |
| `skeleton` | `Skeleton` | Feedback | nat | `blocks.skeleton` | shipped | shadcn |
| `dialog` | `Dialog` | Overlays | nat | `blocks.dialog` | shipped | `<dialog>` / shadcn |
| `navbar` | `Navbar` | Navigation | nat | `blocks.navbar` | shipped | shadcn |
| `badge` | `Badge` | Data display | nat | `blocks.badge` | shipped | shadcn |
| `avatar` | `Avatar` | Data display | nat | `blocks.avatar` | shipped | shadcn |
| `breadcrumb` | `Breadcrumb` | Navigation | nat | `blocks.breadcrumb` | shipped | shadcn |
| `pagination` | `Pagination` | Navigation | nat, act | `blocks.pagination` | shipped | shadcn |
| `progress` | `Progress` | Feedback | nat | `blocks.progress` | shipped | `<progress>` |
| `spinner` | `Spinner` | Feedback | nat | `blocks.spinner` | shipped | CSS animation |
| `button-group` | `ButtonGroup` | Actions | nat | `blocks.button-group` | shipped | shadcn |
| `accordion` | `Accordion` | Data display | nat | `blocks.accordion` | shipped | `<details>` |
| `switch` | `Switch` | Forms | nat | `blocks.switch` | shipped | checkbox semantics |
| `input-group` | `InputGroup` | Forms | nat | `blocks.input-group` | shipped | shadcn |
| `file-input` | `FileInput` | Forms | nat | `blocks.file-input` | shipped | DaisyUI |
| `description-list` | `DescriptionList` | Data display | nat | `blocks.description-list` | shipped | Catalyst |
| `page-heading` | `PageHeading` | App shell | nat | `blocks.page-heading` | shipped | App UI |
| `section-heading` | `SectionHeading` | App shell | nat | `blocks.section-heading` | shipped | App UI |
| `popover` | `Popover` | Overlays | nat | `blocks.popover` | shipped | Popover API |
| `tooltip` | `Tooltip` | Overlays | nat | `blocks.tooltip` | shipped | CSS / title |
| `auth-layout` | `AuthLayout` | App shell | nat | `blocks.auth-layout` | shipped | shadcn login |
| `dashboard-shell` | `DashboardShell` | App shell | nat, act | `blocks.dashboard-shell` | shipped | shadcn dashboard-01 |
| `kbd` | `Kbd` | Data display | nat | `blocks.kbd` | shipped | shadcn |
| `carousel` | `Carousel` | Data display | nat | `blocks.carousel` | shipped | scroll-snap |
| `list` | `List` | Data display | nat | `blocks.list` | shipped | shadcn Item |
| `stat` | `Stat` | Data display | nat | `blocks.stat` | shipped | DaisyUI |
| `timeline` | `Timeline` | Data display | nat | `blocks.timeline` | shipped | DaisyUI |
| `steps` | `Steps` | Navigation | nat | `blocks.steps` | shipped | DaisyUI |
| `link` | `Link` | Navigation | nat | `blocks.link` | shipped | DaisyUI |
| `fieldset` | `Fieldset` | Forms | nat | `blocks.fieldset` | shipped | DaisyUI |

## Catalog (dev/test)

`GET /ux-blocks-core/catalog` — static demo of all **48** roles.

Demo hub: `symfinity/ux-blocks-demo` — `/catalog` includes the same sections with theme jump nav.

## Docs

- [architecture.md](docs/architecture.md) — stage A, kernel CSS boundary
- [porting.md](docs/porting.md) — v1 REF map (toolkit, DaisyUI, Catalyst, App UI)
- [docs/components/](docs/components/) — per-role notes (overlays: [dialog](docs/components/dialog.md), [popover](docs/components/popover.md), [tooltip](docs/components/tooltip.md))

## Extension

Add a row to the [role-registry contract](../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/role-registry.md) and mirror it in `config/ux_roles.yaml` before shipping a new component.

## Test

From product monorepo root:

```bash
cd src/symfinity
make test
# or per-package:
./bin/php vendor/bin/phpunit packages/ux-blocks-core/tests
```

Local package dir (after `composer install` in `packages/ux-blocks-core/`):

```bash
composer test
```

## Primal lab reference (WoWi)

Source: [`var/primal/td-cc-wowi`](../../../../var/primal/td-cc-wowi) (reference only).

| WoWi pattern | Notes for ux-blocks-core |
|--------------|--------------------------|
| `scaleMagic` viewport-filling sections | Layout / hero roles — pair with `ui-kernel` scroll-offset tokens |
| Static marketing sections | Core layout primitives; audience landings → `ux-blocks-marketing` (**026**) |

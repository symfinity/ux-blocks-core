<div align="center">

# UX Blocks Core

### Atomic Symfinity UX Twig components with registry-aligned markup and role CSS

[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](composer.json)
[![Symfony](https://img.shields.io/badge/Symfony-7.4+-343434?style=flat&logo=symfony&logoColor=white)](composer.json)
<br/>
[![CI](https://github.com/symfinity/ux-blocks-core/actions/workflows/ci.yml/badge.svg)](https://github.com/symfinity/ux-blocks-core/actions/workflows/ci.yml)
<br/>
[![Release](https://img.shields.io/packagist/v/symfinity/ux-blocks-core.svg?style=flat&logo=packagist&logoColor=white)](https://packagist.org/packages/symfinity/ux-blocks-core)
[![Downloads](https://img.shields.io/packagist/dt/symfinity/ux-blocks-core.svg?style=flat&logo=packagist&logoColor=white)](https://packagist.org/packages/symfinity/ux-blocks-core)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)

</div>

> [!NOTE]
> **Read-only mirror.**
> See [CONTRIBUTING.md](CONTRIBUTING.md) for how to propose changes.

## Features

- **35 atomic roles** — typography, headings, forms, layout, navigation, feedback, and media primitives (+ eight **094** promotes; `flash`/`flash-stack` **087**; `page-heading`/`section-heading` **089**)
- **Native-first (`nat`)** — styled with ui-kernel tokens; no Stimulus required for default stories
- **Registry-aligned** — `config/ux_roles.yaml` revision 1.4 with `blocks.*` fragment ids
- **Symfony UX Twig components** — `<twig:Button>`, `<twig:Input>`, and siblings
- **Package role CSS** — tier-owned styles under `assets/styles/roles/`
- **Flex recipe** — bundle + AssetMapper paths wired on install

## Interaction profile

| Token | In this package |
|-------|-----------------|
| `nat` | Default for all roles — native HTML + Chameleon kernel / package CSS |
| `act` | Optional on `Button` via ui-action protocol |
| `stl` | **Not used** — interactive overlays live in `symfinity/ux-blocks-extended` |
| `live` | **Not used** — LiveComponent demos live in lab / consumer apps |

## Component inventory

<!-- ux-blocks:registry:start -->
| Role | Twig | Interaction | Fragment | Status |
|------|------|-------------|----------|--------|
| typography | Typography | nat | `blocks.typography` | shipped |
| button | Button | nat, act | `blocks.button` | shipped |
| label | Label | nat | `blocks.label` | shipped |
| input | Input | nat | `blocks.input` | shipped |
| textarea | Textarea | nat | `blocks.textarea` | shipped |
| checkbox | Checkbox | nat | `blocks.checkbox` | shipped |
| radio-group | RadioGroup | nat | `blocks.radio-group` | shipped |
| select | Select | nat | `blocks.select` | shipped |
| switch | Switch | nat | `blocks.switch` | shipped |
| file-input | FileInput | nat | `blocks.file-input` | shipped |
| separator | Separator | nat | `blocks.separator` | shipped |
| divider | Divider | nat | `blocks.divider` | shipped |
| aspect-ratio | AspectRatio | nat | `blocks.aspect-ratio` | shipped |
| scroll-area | ScrollArea | nat | `blocks.scroll-area` | shipped |
| badge | Badge | nat | `blocks.badge` | shipped |
| avatar | Avatar | nat | `blocks.avatar` | shipped |
| kbd | Kbd | nat | `blocks.kbd` | shipped |
| link | Link | nat | `blocks.link` | shipped |
| progress | Progress | nat | `blocks.progress` | shipped |
| spinner | Spinner | nat | `blocks.spinner` | shipped |
| skeleton | Skeleton | nat | `blocks.skeleton` | shipped |
| image | Image | nat | `blocks.image` | shipped |
| figure | Figure | nat | `blocks.figure` | shipped |
| flash | Flash | nat | `blocks.flash` | shipped |
| flash-stack | FlashStack | nat | `blocks.flash-stack` | shipped |
| page-heading | PageHeading | nat | `blocks.page-heading` | shipped |
| section-heading | SectionHeading | nat | `blocks.section-heading` | shipped |
| grid | Grid | nat | `blocks.grid` | shipped |
| stack | Stack | nat | `blocks.stack` | shipped |
| list | List | nat | `blocks.list` | shipped |
| breadcrumb | Breadcrumb | nat | `blocks.breadcrumb` | shipped |
| pagination | Pagination | nat, act | `blocks.pagination` | shipped |
| fieldset | Fieldset | nat | `blocks.fieldset` | shipped |
| input-group | InputGroup | nat | `blocks.input-group` | shipped |
| button-group | ButtonGroup | nat | `blocks.button-group` | shipped |
<!-- ux-blocks:registry:end -->

**Variant parity (091):** role CSS under `assets/styles/roles/{button,badge,link,input}.css`; Catalyst-style matrix contract in org specs `3-ux-component-catalog/contracts/variant-parity-matrix.md`; dogfood smoke `ui-lab` `/kernel/button-matrix`.

Handbook pages: [docs/components.md](docs/components.md) and [docs/components/](docs/components/).

## Prerequisites

Add the [symfinity/recipes](https://github.com/symfinity/recipes) Flex endpoint to your project's `composer.json` (see [recipes README](https://github.com/symfinity/recipes/blob/main/README.md)) — recipes are not in Symfony's official recipe repository yet.

Install **ui-kernel** (theme CSS). **ux-blocks** (registry SDK) resolves from [Packagist](https://packagist.org/packages/symfinity/ux-blocks) as a dependency of this package.

```bash
composer require symfinity/ui-kernel
```

## Installation

```bash
composer require symfinity/ux-blocks-core
```

The Flex recipe registers the bundle for all environments. See [Installation](docs/installation.md).

## Quick Start

```twig
{# templates/base.html.twig — ui-kernel head (required) #}
<head>
    {{ ui_kernel_theme_boot_script() }}
    {{ ui_kernel_css()|raw }}
</head>
```

```twig
{# templates/demo.html.twig #}
<twig:Button variant="default">Save</twig:Button>
<twig:Label for="email">Email</twig:Label>
<twig:Input id="email" name="email" type="email" placeholder="you@example.com" />
```

```twig
{# templates/base.html.twig — session flashes (viewport top) #}
<twig:FlashStack placement="top">
  {% for message in app.flashes('success') %}
    <twig:Flash variant="success">{{ message }}</twig:Flash>
  {% endfor %}
  {% for message in app.flashes('error') %}
    <twig:Flash variant="error">{{ message }}</twig:Flash>
  {% endfor %}
</twig:FlashStack>
```

See [Quick start](docs/quickstart.md) for the full walkthrough.

## Documentation

- **[Quick start](docs/quickstart.md)** — ui-kernel + first components in minutes
- **[Installation](docs/installation.md)** — Flex, dependencies, verify
- **[Configuration](docs/configuration.md)** — auto-wiring and catalog route
- **[Components](docs/components.md)** — role index and fragment prefix
- **[Upgrade](docs/upgrade.md)** — first release and future migrations

## Typography R2 browser baseline

Native trim and wrap polish (**104**) is progressive enhancement:

| Feature | Supporting browsers (enhanced path) | Fallback |
|---------|-------------------------------------|----------|
| `text-wrap: balance` | Chromium 114+, Firefox 121+, Safari 17.5+ | Normal wrap — layout unchanged |
| `text-wrap: pretty` | Chromium 117+, Firefox 121+, Safari 17.5+ | Normal wrap on prose container |
| `text-box-trim` / `text-box-edge` | Chromium 133+, Safari 18.2+ | Pre-trim spacing from **089** tokens |

Mixed-script and CJK headlines may hit engine line caps (Chromium ~6 lines, Firefox ~10) — balance degrades to normal wrap without breakage. `Typography:Muted` intentionally skips trim to preserve descenders on helper text.

## Requirements

- PHP 8.2 or higher
- Symfony 7.4 or 8.x
- `symfinity/ui-kernel` ^0.1 and `symfinity/ux-blocks` ^0.1 ([Packagist](https://packagist.org/packages/symfinity/ux-blocks))

## Support

- [GitHub Issues](https://github.com/symfinity/ux-blocks-core/issues)
- [Security](.github/SECURITY.md)
- [Contributing](CONTRIBUTING.md)

## License

[MIT](LICENSE)

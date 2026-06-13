<div align="center">

# UX Blocks Core

### Atomic Symfony UX Twig components with registry-aligned markup and role CSS

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

- **24 atomic roles** — typography, forms, layout, feedback, and media primitives
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

| Role | Twig | Category | Interaction | Fragment | Status |
|------|------|----------|-------------|----------|--------|
| typography | Typography | Typography | nat | `blocks.typography` | shipped |
| button | Button | Actions | nat, act | `blocks.button` | shipped |
| label | Label | Forms | nat | `blocks.label` | shipped |
| input | Input | Forms | nat | `blocks.input` | shipped |
| textarea | Textarea | Forms | nat | `blocks.textarea` | shipped |
| checkbox | Checkbox | Forms | nat | `blocks.checkbox` | shipped |
| radio-group | RadioGroup | Forms | nat | `blocks.radio-group` | shipped |
| select | Select | Forms | nat | `blocks.select` | shipped |
| switch | Switch | Forms | nat | `blocks.switch` | shipped |
| file-input | FileInput | Forms | nat | `blocks.file-input` | shipped |
| separator | Separator | Layout | nat | `blocks.separator` | shipped |
| divider | Divider | Layout | nat | `blocks.divider` | shipped |
| aspect-ratio | AspectRatio | Layout | nat | `blocks.aspect-ratio` | shipped |
| scroll-area | ScrollArea | Layout | nat | `blocks.scroll-area` | shipped |
| badge | Badge | Feedback | nat | `blocks.badge` | shipped |
| progress | Progress | Feedback | nat | `blocks.progress` | shipped |
| spinner | Spinner | Feedback | nat | `blocks.spinner` | shipped |
| skeleton | Skeleton | Feedback | nat | `blocks.skeleton` | shipped |
| empty | Empty | Feedback | nat | `blocks.empty` | shipped |
| avatar | Avatar | Media | nat | `blocks.avatar` | shipped |
| image | Image | Media | nat | `blocks.image` | shipped |
| figure | Figure | Media | nat | `blocks.figure` | shipped |
| kbd | Kbd | Typography | nat | `blocks.kbd` | shipped |
| link | Link | Navigation | nat | `blocks.link` | shipped |

Handbook pages: [docs/components.md](docs/components.md) and [docs/components/](docs/components/).

## Prerequisites

Add the [symfinity/recipes](https://github.com/symfinity/recipes) Flex endpoint to your project's `composer.json` (see [recipes README](https://github.com/symfinity/recipes/blob/main/README.md)) — recipes are not in Symfony's official recipe repository yet.

Install **ui-kernel** and **ux-blocks** (or let Composer resolve them as dependencies of this package):

```bash
composer require symfinity/ui-kernel symfinity/ux-blocks
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

See [Quick start](docs/quickstart.md) for the full walkthrough.

## Documentation

- **[Quick start](docs/quickstart.md)** — ui-kernel + first components in minutes
- **[Installation](docs/installation.md)** — Flex, dependencies, verify
- **[Configuration](docs/configuration.md)** — auto-wiring, catalog route, SchemeSwitch
- **[Components](docs/components.md)** — role index and fragment prefix
- **[Upgrade](docs/upgrade.md)** — first release and future migrations

## Requirements

- PHP 8.2 or higher
- Symfony 7.4 or 8.x
- `symfinity/ui-kernel` ^0.1 and `symfinity/ux-blocks` ^0.1

## Support

- [GitHub Issues](https://github.com/symfinity/ux-blocks-core/issues)
- [Security](.github/SECURITY.md)
- [Contributing](CONTRIBUTING.md)

## License

[MIT](LICENSE)

<div align="center">

# Ux Blocks Core

### Symfinity UX Blocks Core — fourteen v0 Symfony UX Twig components with registry-aligned markup

[![PHP Version](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php&logoColor=white)](composer.json)
[![Symfony](https://img.shields.io/badge/Symfony-7.4+-343434?style=flat&logo=symfony&logoColor=white)](composer.json)

<br/>
[![PHPUnit](https://github.com/symfinity/symfinity/actions/workflows/phpunit.yml/badge.svg)](https://github.com/symfinity/symfinity/actions/workflows/phpunit.yml)
[![Coverage](https://github.com/symfinity/symfinity/actions/workflows/coverage.yml/badge.svg)](https://github.com/symfinity/symfinity/actions/workflows/coverage.yml)
[![PHPStan](https://github.com/symfinity/symfinity/actions/workflows/phpstan.yml/badge.svg)](https://github.com/symfinity/symfinity/actions/workflows/phpstan.yml)
<br/>
[![Psalm](https://github.com/symfinity/symfinity/actions/workflows/psalm.yml/badge.svg)](https://github.com/symfinity/symfinity/actions/workflows/psalm.yml)
[![Infection](https://github.com/symfinity/symfinity/actions/workflows/infection.yml/badge.svg)](https://github.com/symfinity/symfinity/actions/workflows/infection.yml)
[![Code Style](https://img.shields.io/badge/code%20style-CS%20Fixer-5c4dbc?style=flat)](https://github.com/symfinity/symfinity/actions/workflows/php-cs-fixer.yml)
<br/>
[![Release](https://img.shields.io/packagist/v/symfinity/ux-blocks-core.svg?style=flat&logo=packagist&logoColor=white)](https://packagist.org/packages/symfinity/ux-blocks-core)
[![Downloads](https://img.shields.io/packagist/dt/symfinity/ux-blocks-core.svg?style=flat&logo=packagist&logoColor=white)](https://packagist.org/packages/symfinity/ux-blocks-core)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat)](LICENSE)

</div>

---

## Documentation

| Topic | Page |
|-------|------|
| Architecture | [docs/architecture.md](docs/architecture.md) |
| Components | [docs/components.md](docs/components.md) |
| Configuration | [docs/configuration.md](docs/configuration.md) |
| Index | [docs/index.md](docs/index.md) |
| Installation | [docs/installation.md](docs/installation.md) |
| Porting | [docs/porting.md](docs/porting.md) |
| Quickstart | [docs/quickstart.md](docs/quickstart.md) |
| Reference | [docs/reference.md](docs/reference.md) |
| Troubleshooting | [docs/troubleshooting.md](docs/troubleshooting.md) |
| Upgrade | [docs/upgrade.md](docs/upgrade.md) |
| Usage | [docs/usage.md](docs/usage.md) |
| Component: Alert | [docs/components/alert.md](docs/components/alert.md) |
| Component: Button | [docs/components/button.md](docs/components/button.md) |
| Component: Card | [docs/components/card.md](docs/components/card.md) |
| Component: Checkbox | [docs/components/checkbox.md](docs/components/checkbox.md) |
| Component: Dialog | [docs/components/dialog.md](docs/components/dialog.md) |
| Component: Empty | [docs/components/empty.md](docs/components/empty.md) |
| Component: Field | [docs/components/field.md](docs/components/field.md) |
| Component: Input | [docs/components/input.md](docs/components/input.md) |
| Component: Label | [docs/components/label.md](docs/components/label.md) |
| Component: Popover | [docs/components/popover.md](docs/components/popover.md) |
| Component: Radio Group | [docs/components/radio-group.md](docs/components/radio-group.md) |
| Component: Select | [docs/components/select.md](docs/components/select.md) |
| Component: Separator | [docs/components/separator.md](docs/components/separator.md) |
| Component: Table | [docs/components/table.md](docs/components/table.md) |
| Component: Textarea | [docs/components/textarea.md](docs/components/textarea.md) |
| Component: Tooltip | [docs/components/tooltip.md](docs/components/tooltip.md) |
| Component: Typography | [docs/components/typography.md](docs/components/typography.md) |

## Requirements

- PHP 8.2+
- Symfony 7.4+ (Flex recipe when available)

## Install

```bash
composer require symfinity/ux-blocks-core
```

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

## Planning (R2)

**SYMFINITY-47** — ux-blocks-core R2: registry 48 → 50 (`collapsible`, `image`); spinner variants; overlay a11y pass.

| Contract | Path |
|----------|------|
| Core R2 registry | [core-r2-role-registry](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/core-r2-role-registry.md) |
| Collapsible | [collapsible-role](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/collapsible-role.md) |
| Image | [image-role](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/image-role.md) |
| Spinner variants | [spinner-variants](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/spinner-variants.md) |
| Overlay a11y | [overlay-a11y-pass](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/overlay-a11y-pass.md) |

# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Changed

- **098 compound elevation** — solid `button` roles use `var(--ui-shadow-sm|md)` with hover lift gated by `prefers-reduced-motion`

## [0.1.0] - 2026-06-14

### Added

- Initial release of UX Blocks Core bundle for Symfony
- **24 atomic component roles** with UX Twig components, `[data-ui-role]` markup, and package-owned role CSS (`blocks.*` fragment prefix)
- Registry `config/ux_roles.yaml` at revision **1.4** — typography, actions, forms, layout, feedback, and media tiers
- Symfony Flex recipe `0.1` — bundle registered for all environments
- Auto-wiring: AssetMapper path for `assets/`, Twig component namespace, Twig template path
- Optional dev catalog route `/ux-blocks-core/catalog` for role previews
- Optional `SchemeSwitch` role with theme scheme PATCH when `symfinity/ui-kernel` is present
- Consumer handbook under `docs/` including component index and per-role pages
- Symfony 7.4 and 8.x compatibility (PHP 8.2+)

### Notes

- Core tier is **native-first** (`nat`) — default stories need no package Stimulus controllers; `Button` also supports declarative `act` via ui-action
- Requires `symfinity/ui-kernel` (theme tokens + shared form-control CSS) and `symfinity/ux-blocks` ^0.1 on [Packagist](https://packagist.org/packages/symfinity/ux-blocks) (registry schema)
- Split mirror CI: PHP 8.2–8.5 × Symfony 7.4 / 8.0 / 8.1 (see `.github/workflows/ci.yml`)

# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.4] - 2026-06-29

### Fixed

- **Flash `danger` variant** — role CSS maps `[data-ui-variant=danger]` to `--ui-color-danger` (feedback flashes using the canonical danger variant now render with the correct tone)

### Added

- **ROADMAP.md** — public milestone table for the 0.1.x → 1.0.x release line

### Notes

- CSS-only patch — no Twig component or registry API changes
- Hard-refresh the browser or clear AssetMapper cache in dev after upgrade if flash tones look stale

## [0.1.3] - 2026-06-27

### Added

- **`ResolvesFeedbackVariantIcon` trait** — shared Twig helper on `Symfinity\UxBlocksCore\Twig` for feedback variants (`success`, `danger`, `warning`, `info`) with default Lucide icon names, explicit `icon` override, and empty-string suppression
- Downstream tiers (for example `symfinity/ux-blocks-interactive` `Toast:Item`) may `use` this trait instead of duplicating variant→icon mapping

### Changed

- **`Flash` component** — icon resolution delegated to `ResolvesFeedbackVariantIcon`; templates and exposed props unchanged (`variant`, `icon`, `iconDecorative`, `resolved_icon`)

### Notes

- Patch release — no registry or role CSS changes
- Packages importing `ResolvesFeedbackVariantIcon` must require `symfinity/ux-blocks-core` **^0.1.3**

## [0.1.2] - 2026-06-25

### Changed

- **Role CSS** — refreshed compiled styles for `card`, `dialog`, `input`, `link`, `page-heading`, `table`, `tabs`, `typography`, and `stat` roles aligned with delegated profiler shell chrome
- **Filter bar** — new `filter-bar` role stylesheet for list/toolbar filter UI (`assets/styles/roles/filter-bar.css`)
- **Dialog** — expanded modal/sheet surface styles in `assets/styles/roles/dialog.css`
- **Tabs** — simplified tab strip CSS; fewer literals, clearer active/hover states
- **`bundle.css`** — regenerated entry bundle for AssetMapper consumers

### Notes

- No Twig component or registry API changes — CSS-only patch
- Sass sources under `assets/scss/` remain monorepo-only; split mirrors ship committed `assets/styles/**` CSS

## [0.1.0] - 2026-06-23

### Added

- Initial release of UX Blocks Core bundle for Symfony
- **25 atomic component roles** with UX Twig components, `[data-ui-role]` markup, and package-owned role CSS (`blocks.*` fragment prefix)
- Registry `config/ux_roles.yaml` at revision **1.4** — typography, actions, layout, navigation, feedback, and media tiers
- Symfony Flex recipe `0.1` — bundle registered for all environments
- Auto-wiring: AssetMapper path for `assets/`, Twig component namespace, Twig template path
- **Native-first (`nat`)** styling — default stories need no package Stimulus controllers; `Button` and `Pagination` also support declarative `act` when `symfinity/ui-action` is installed
- **Flash** and **FlashStack** for session feedback with dismiss collapse and icon slots
- **PageHeading** and **SectionHeading** with optional icon and actions region
- **Figure**, **Image**, and **Spinner** media and loading primitives
- Icon slots on **Button**, **Badge**, **Link**, **Flash**, and heading roles; decorative icon watermark on **Flash**
- Variant and appearance CSS for **Button**, **Badge**, and **Link** aligned with platform semantic colour vocabulary
- Typography polish — balance and pretty text-wrap on headings; `@supports`-gated trim on display typography
- Solid **Button** elevation — `var(--ui-shadow-sm|md)` with hover lift gated by `prefers-reduced-motion`
- Sass-authored role CSS compiled to `assets/styles/` for AssetMapper delivery
- Consumer handbook under `docs/` including component index and per-role pages
- Symfony 7.4 and 8.x compatibility (PHP 8.2+)

### Notes

- This package ships **components and role CSS only** — no HTTP routes or bundled preview gallery
- Form field roles (`Label`, `Input`, …) ship in [`symfinity/ux-blocks-form`](https://github.com/symfinity/ux-blocks-form); overlay components in [`symfinity/ux-blocks-extended`](https://github.com/symfinity/ux-blocks-extended)
- Requires `symfinity/ux-blocks` ^0.1 on [Packagist](https://packagist.org/packages/symfinity/ux-blocks); optional themed apps add `symfinity/ui-kernel` (see SDK `suggest`)

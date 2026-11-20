# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [0.1.8] - 2026-11-20

### Changed

- Requires `symfinity/ux-blocks` `^0.1.7`
- The Sass build keeps quoted attribute selectors (`extra.symfinity.sass.quote_attributes`)

### Fixed

- A section heading with actions wraps onto the next line when the page is narrow, so the buttons stay inside the screen
- Level 1 heading spacing, icon size, and title size follow the heading the template actually renders. The title size still applies when the theme does not define the larger font tokens

## [0.1.7] - 2026-11-20

### Added

- `<twig:Navbar>` with role `navbar` and fragment `blocks.navbar`. `blocks.ext.navbar` stays as an alias until the next minor
- Stack accepts `direction="inline"`: a wrapping row at every width. `horizontal` is unchanged. Any other value is treated as `vertical`
- Badge accepts `appearance` (`solid` or `outline`). `variant="outline"` is primary plus outline
- Optional `symfinity_ux_blocks_core.ui_assets.always_tiers` lists tiers whose styles every full page receives. The default is an empty list
- An unknown colour name still falls back to the default and logs one warning when a logger is available. The package now requires `psr/log`

### Changed

- The role registry reads the catalogue of every installed tier, core first. `UxRoleRegistry` takes a list of catalogue paths (`$yamlPaths`) instead of one path string. Role attributes on Twig components still come from the core catalogue only
- Component docs ship in the Composer archive. The pagination and grid pages show their child markup

### Fixed

- Responses without a `<head>`, including Live re-renders, no longer receive inline tier styles
- A page that renders a component from an installed tier receives that tier's stylesheet
- PHPUnit bootstrap registers this package's PSR-4 prefixes from `composer.json` after loading the monorepo or package autoload, and narrows the decoded autoload sections before reading `psr-4`

## [0.1.6] - 2026-07-05

### Added

- **Automatic inline tier CSS** — UX Twig components activate the correct CSS stack from registry fragment ids; an HTTP response subscriber injects `<style id="ux-blocks-{tier}-css">` blocks into `<head>` once per HTML response when `data-ui-role` markup is present and no style markers exist yet
- **`ux_blocks_ui_assets()` Twig function** — optional manual emit in layout for debugging or explicit head placement (idempotent with the subscriber)
- **Fragment → tier mapping** — `blocks.core.*` → core; `blocks.form.*` → core + form; `blocks.ext.*` → core + form + extended; `blocks.int.*` / `blocks.live.*` → through interactive; `blocks.marketing.*` and `blocks.shop.*` → marketing / ecommerce stacks when sibling tier packages are installed
- Handbook [verification.md](docs/verification.md) — P2 integration profile smoke (auto-injected `id="ux-blocks-core-css"`)
- **Grouped component examples** — handbook example YAMLs use `groups[]` with richer variant and size matrices

### Changed

- **Role CSS cascade** — committed `blocks-core.css` and `BlocksCoreCssProvider::stylesheet()` wrap tier output in `@layer blocks.core` for ui-kernel layer ordering
- **Filter bar / log table** — silenced-row accent uses `var(--ui-color-accent)` instead of a hardcoded colour literal
- **Quickstart** — documents the no–ui-kernel auto-inject path and optional manual `ux_blocks_ui_assets()` hook

### Notes

- **ui-kernel remains optional** — themed apps keep loading kernel CSS in layout; clean Twig-only installs get styled components without manual tier wiring
- Cross-tier CSS loads only when the matching tier package is installed and its fragments render on the page
- No registry or Twig component prop API changes — upgrading from **0.1.5** needs no template edits

## [0.1.5] - 2026-06-29

### Changed

- **Split mirror CI** — Composer package cache and `GITHUB_TOKEN` authentication so GitHub Actions reliably resolves `symfinity/*` dependencies across the PHP × Symfony matrix

### Added

- **SUPPORTERS.md** — sponsor acknowledgment page linked from the split mirror README ecosystem
- Composer **`funding` metadata and `.github/FUNDING.yml`** for [GitHub Sponsors](https://github.com/sponsors/serotoninja)

### Notes

- No Twig component, registry, or role CSS changes — documentation and CI maintenance patch
- Upgrading from **0.1.4** needs no template or config edits

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
- `bundle.css` — regenerated entry bundle for AssetMapper consumers

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

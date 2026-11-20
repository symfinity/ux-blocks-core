# Configuration

UX Blocks Core ships **zero required app YAML**. The bundle prepends AssetMapper paths, Twig template paths, and UX Twig Component defaults at compile time.

## What the bundle configures

| Concern | Behavior |
|---------|----------|
| AssetMapper | Maps `assets/` to logical namespace `ux-blocks-core` |
| Twig templates | Namespace `UxBlocksCore` → `templates/` |
| UX Twig components | `Symfinity\UxBlocksCore\Twig\Components\` → `components/` templates |
| Role registry | `config/ux_roles.yaml` (revision **1.4**) — read-only reference inside the package |
| Services | Autowired listeners and CSS provider — see bundle `config/services.yaml` |

Applications **do not** copy bundle `config/` into `config/packages/`.

## Style injection

The bundle adds the inline `<style id="ux-blocks-{tier}-css">` blocks for every tier a page uses. It reads which tiers are used from the role catalogue (`config/ux_roles.yaml`) of **every installed ux-blocks tier**, so a `Card` turns on the extended styles and a `Tabs` turns on the interactive styles.

Styles go into **full pages only**: responses that have a `<head>` element. Fragments (Turbo frames, AJAX snippets) and Live component re-renders are left untouched, because the page that hosts them already has the styles.

### `ui_assets.always_tiers`

A tier that first appears **inside** a Live re-render has no full page to carry its styles. List such tiers once and every full page gets them:

```yaml
# config/packages/symfinity_ux_blocks_core.yaml
symfinity_ux_blocks_core:
  ui_assets:
    always_tiers: [marketing]   # allowed: core, form, extended, interactive, marketing, ecommerce
```

The default is `[]`: pages that use only core components stay as light as before.

## Routes

This package ships **no HTTP routes** — only Twig components, registry YAML, and AssetMapper assets.

## Themed apps (optional ui-kernel)

Role CSS uses `var(--ui-*)` tokens. When **symfinity/ui-kernel** is installed, include theme CSS in your layout; non-interactive apps can use ui-kernel redirect links, boot script, or layout chrome — see ui-kernel [theme-preference](https://github.com/symfinity/ui-kernel/blob/main/docs/theme-preference.md).

## Stimulus and icons

Default core roles are `nat` — no package Stimulus controllers required. Optional:

- `symfony/ux-icons` for roles that render icons
- `symfinity/ui-action` for declarative `act` on `Button`

## See also

- [Installation](installation.md)
- [Components](components.md)
- [ui-kernel configuration](https://github.com/symfinity/ui-kernel/blob/main/docs/configuration.md)

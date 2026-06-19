# Configuration

UX Blocks Core ships **zero required app YAML**. The bundle prepends AssetMapper paths, Twig template paths, and UX Twig Component defaults at compile time.

## What the bundle configures

| Concern | Behavior |
|---------|----------|
| AssetMapper | Maps `assets/` to logical namespace `ux-blocks-core` |
| Twig templates | Namespace `UxBlocksCore` → `templates/` |
| UX Twig components | `Symfinity\UxBlocksCore\Twig\Components\` → `components/` templates |
| Role registry | `config/ux_roles.yaml` (revision **1.4**) — read-only reference inside the package |
| Services | Autowired controllers and CSS provider — see bundle `config/services.yaml` |

Applications **do not** copy bundle `config/` into `config/packages/`.

## Optional routes

The bundle imports `config/routes.yaml`:

| Route name | Path | Purpose |
|------------|------|---------|
| `ux_blocks_core_catalog` | `/ux-blocks-core/catalog` | Dev role preview gallery |

Restrict or disable these routes in production if they are not needed — treat the catalog as internal tooling.

## Color scheme switching

Foundation tier (`ux-blocks-core`) stays HTML/CSS-only. For an interactive light/dark toggle with PATCH support, use **`SchemeSwitch`** from **`symfinity/ux-blocks-interactive`** and import `config/routes/theme-scheme.yaml` when **symfinity/ui-kernel** is installed. Non-interactive apps can use ui-kernel redirect links, boot script, or layout chrome instead — see ui-kernel [theme-preference](https://github.com/symfinity/ui-kernel/blob/main/docs/theme-preference.md).

## Stimulus and icons

Default core roles are **`nat`** — no package Stimulus controllers required. Optional:

- `symfony/ux-icons` for roles that render icons
- `symfinity/ui-action` for declarative `act` on `Button`

## See also

- [Installation](installation.md)
- [Components](components.md)
- [ui-kernel configuration](https://github.com/symfinity/ui-kernel/blob/main/docs/configuration.md)

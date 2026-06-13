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
| `ui_kernel_theme_scheme` | `/_ui/theme/scheme` (PATCH) | Theme scheme toggle for `SchemeSwitch` when ui-kernel is present |

Restrict or disable these routes in production if they are not needed — treat the catalog as internal tooling.

## SchemeSwitch and ui-kernel

The `SchemeSwitch` role can PATCH `/_ui/theme/scheme` when **symfinity/ui-kernel** is installed and theme cookies are enabled. See ui-kernel handbook for theme configuration.

## Stimulus and icons

Default core roles are **`nat`** — no package Stimulus controllers required. Optional:

- `symfony/ux-icons` for roles that render icons
- `symfinity/ui-action` for declarative `act` on `Button`

## See also

- [Installation](installation.md)
- [Components](components.md)
- [ui-kernel configuration](https://github.com/symfinity/ui-kernel/blob/main/docs/configuration.md)

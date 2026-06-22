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

## Routes

This package ships **no HTTP routes** — only Twig components, registry YAML, and AssetMapper assets.

## Themed apps (optional ui-kernel)

Role CSS uses `var(--ui-*)` tokens. When **symfinity/ui-kernel** is installed, include theme CSS in your layout; non-interactive apps can use ui-kernel redirect links, boot script, or layout chrome — see ui-kernel [theme-preference](https://github.com/symfinity/ui-kernel/blob/main/docs/theme-preference.md).

## Stimulus and icons

Default core roles are **`nat`** — no package Stimulus controllers required. Optional:

- `symfony/ux-icons` for roles that render icons
- `symfinity/ui-action` for declarative `act` on `Button`

## See also

- [Installation](installation.md)
- [Components](components.md)
- [ui-kernel configuration](https://github.com/symfinity/ui-kernel/blob/main/docs/configuration.md)

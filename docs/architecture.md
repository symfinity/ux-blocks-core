# Architecture — symfinity/ux-blocks-core

**Feature:** [symfinity 003 — ux-component-catalog](../../../../specs/symfinity/symfinity/3-ux-component-catalog/spec.md)  
**Stage:** A (Chameleon integration stage A per [symfony-ux-compatibility](../../../../specs/symfinity/symfinity/2-ui-kernel/contracts/symfony-ux-compatibility.md))

## Role in the stack

| Layer | Responsibility |
|-------|----------------|
| `symfinity/ux-blocks-core` | Symfony UX Twig components; emits `data-ui-role`, `data-ui-fragment`, prop-derived `data-ui-*` |
| `symfinity/ui-kernel` | `[data-ui-role]` CSS via `CssGenerator`; theme tokens; showcase |
| REF | [symfony/ux-toolkit](https://github.com/symfony/ux-toolkit) `kits/shadcn/` — read-only port source |

Canonical role vocabulary: [role-registry contract](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/role-registry.md).

Machine-readable export: `config/ux_roles.yaml` (`ux_role_registry: "1.1"`, prefix `blocks`).

## Package layout

```text
packages/ux-blocks-core/
├── config/ux_roles.yaml      # registry mirror
├── src/Twig/Components/      # #[AsTwigComponent] PHP classes
├── templates/components/     # port-transformed Twig (no Tailwind)
│   └── _shared/              # reusable slot wrappers (div, p, h3, table parts, …)
└── templates/catalog.html.twig
```

Nested slot components (e.g. `Card:Title`, `Field:Error`) reference shared templates under `templates/components/_shared/` by HTML tag. Registry root components keep dedicated templates with `data-ui-*` attributes.

## CSS boundary

Components **MUST NOT** ship Tailwind, `html_cva`, or utility-class variant maps. Appearance comes from ui-kernel `[data-ui-role]` rules only.

## Catalog route

Dev/test fixture: `GET /ux-blocks-core/catalog` — one section per v0 registry role.

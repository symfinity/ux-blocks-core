# UX Blocks core — v1 port map

REF sources are **read-only** — [port-semantics-ref](https://github.com/symfinity/symfinity/blob/main/specs/symfinity/symfinity/3-ux-component-catalog/contracts/port-semantics-ref.md). **MUST NOT** `require symfony/ux-toolkit`.

Toolkit paths are relative to `symfony/ux-toolkit` `kits/shadcn/{slug}/` unless noted. DaisyUI / Catalyst / App UI are **markup and composition** references only.

| Role | Category | Interaction | Toolkit (shadcn) | DaisyUI | Catalyst | Tailwind App UI |
|------|----------|-------------|------------------|---------|----------|-----------------|
| `grid` | Layout | nat | `grid/` | — | — | — |
| `stack` | Layout | nat | `stack/` | stack | — | — |
| `scroll-area` | Layout | nat | — | — | — | — |
| `aspect-ratio` | Layout | nat | `aspect-ratio/` | — | — | — |
| `divider` | Layout | nat | — | divider | — | — |
| `skeleton` | Feedback | nat | `skeleton/` | — | — | — |
| `dialog` | Overlays | nat | `dialog/` | — | — | — |
| `navbar` | Navigation | nat | `navbar/` | — | — | — |
| `badge` | Data display | nat | `badge/` | — | — | — |
| `avatar` | Data display | nat | `avatar/` | — | — | — |
| `breadcrumb` | Navigation | nat | `breadcrumb/` | — | — | — |
| `pagination` | Navigation | nat, act | `pagination/` | — | — | — |
| `progress` | Feedback | nat | — | — | — | — |
| `spinner` | Feedback | nat | — | — | — | — |
| `button-group` | Actions | nat | `button-group/` | — | — | — |
| `accordion` | Data display | nat | — | — | — | — |
| `switch` | Forms | nat | — | toggle | — | — |
| `input-group` | Forms | nat | `input-group/` | — | — | — |
| `file-input` | Forms | nat | — | file-input | — | — |
| `description-list` | Data display | nat | — | — | description list | — |
| `page-heading` | App shell | nat | — | — | — | page heading |
| `section-heading` | App shell | nat | — | — | — | section heading |
| `popover` | Overlays | nat | `popover/` | — | — | — |
| `tooltip` | Overlays | nat | — | — | — | — |
| `auth-layout` | App shell | nat | login blocks | — | — | — |
| `dashboard-shell` | App shell | nat, act | `dashboard-01` structure | — | — | — |
| `kbd` | Data display | nat | `kbd/` | — | — | — |
| `carousel` | Data display | nat | — | — | — | — |
| `list` | Data display | nat | `item/` | — | — | — |
| `stat` | Data display | nat | — | stat | — | — |
| `timeline` | Data display | nat | — | timeline | — | — |
| `steps` | Navigation | nat | — | steps | — | — |
| `link` | Navigation | nat | — | link | — | — |
| `fieldset` | Forms | nat | — | fieldset | — | — |

**Native / CSS-only (no toolkit slug):**

| Role | Notes |
|------|--------|
| `scroll-area` | overflow CSS; max block size on root |
| `progress` | `<progress>` |
| `spinner` | CSS `ui-spin` keyframes (kernel) |
| `accordion` | `<details>` / `<summary>` |
| `carousel` | CSS scroll-snap |
| `tooltip` | `title` / `aria-describedby`; kernel positions inline host |

**Alias:** prose `modal` → registry role `dialog` (`blocks.dialog`).

**v0 roles** (unchanged): see package README and [role-registry](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/role-registry.md) § v0 table — toolkit `kits/shadcn/{slug}/` per role.

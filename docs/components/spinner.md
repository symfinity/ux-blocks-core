# spinner

**Role:** `spinner`  
**Fragment id:** `blocks.spinner`  
**Twig:** `Spinner`

Loading indicator with explicit **size** and **density** variants (R2).

| Prop | Default | Values |
|------|---------|--------|
| `size` | `md` | `sm`, `md`, `lg` |
| `density` | `inline` | `inline`, `block` |
| `label` | — | Optional accessible name (`role="status"`) |
| `visible` | `true` | Hide visually while keeping status semantics |

DOM hooks: `data-ui-size`, `data-ui-density` on root. Omitting props preserves pre-R2 default render (`md` + `inline`).

## Variant matrix

| size | density | Use case |
|------|---------|----------|
| md | inline | Default baseline |
| sm | inline | Button row / compact controls |
| lg | block | Card-level loading |
| sm | block | Compact centered loader |

# Button

**Role:** `button`  
**Fragment id:** `blocks.button`  
**Twig:** `<twig:Button>`

Primary action control — native `<button>` or link-styled anchor when `as="a"`. Supports Chameleon colour × appearance × size matrix and optional declarative **ui-action** (`act`).

## Overview

Use **Button** for form submits, dialog confirmations, and navigation actions that should look like buttons. For text-only navigation in prose, prefer the **Link** role (when installed) or a plain anchor.

Loading state sets `disabled` and `data-ui-state="loading"` so double-submit is blocked while async work runs.

## Properties

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | string | `primary` | Semantic colour: `primary`, `secondary`, `accent`, `success`, `danger`, `info`, `warning`, `neutral` |
| `appearance` | string | `solid` | Surface style: `solid`, `soft`, `outline`, `ghost`, `link` |
| `size` | string | `md` | Control size: `sm`, `md`, `lg` |
| `as` | string | `button` | `button` or `a` (link mode) |
| `href` | string | `#` | Used when `as="a"` |
| `disabled` | bool | `false` | Disables interaction |
| `loading` | bool | `false` | Loading spinner + disabled |
| `block` | bool | `false` | Full-width layout |
| `icon` | string \| null | `null` | UX Icons name when set |
| `iconPosition` | string | `start` | `start` or `end` |
| `iconDecorative` | bool | `true` | When false, icon gets `aria-hidden="false"` handling via label text |

Legacy `variant="ghost"` maps to `variant="neutral"` + `appearance="ghost"`. Legacy `size="default"` maps to `md`.

Pass additional native attributes (`type`, `form`, `aria-*`, …) through the Twig component attribute bag.

## Examples

Handbook live previews read `config/component-examples/button.yaml` when the hybrid page runtime is enabled. Representative Twig:

```twig
{# Primary solid #}
<twig:Button variant="primary" appearance="solid">Save changes</twig:Button>

{# Outline secondary #}
<twig:Button variant="secondary" appearance="outline">Cancel</twig:Button>

{# Link appearance #}
<twig:Button variant="primary" appearance="link" as="a" href="/docs">Read docs</twig:Button>

{# Loading #}
<twig:Button variant="primary" :loading="true">Saving…</twig:Button>

{# With icon #}
<twig:Button variant="primary" icon="tabler:plus">Add item</twig:Button>
```

## Interaction

| Token | Notes |
|-------|-------|
| `nat` | Default — kernel + package CSS |
| `act` | Optional `data-ui-action` for declarative Turbo / ui-action routing |

## Accessibility

- Use visible label text or `aria-label` when the button has no text (icon-only).
- When `disabled` or `loading`, the control is not focusable for activation.
- Link mode (`as="a"`) must receive a meaningful `href`; do not use `#` in production without a click handler.

## Related components

- [Input](input.md) — often paired in forms
- [Label](label.md) — associates text with form controls
- `symfinity/ux-blocks-extended` — **ButtonGroup**, compound layouts

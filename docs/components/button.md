# Button

Triggers actions and form submits — styled with semantic colour and appearance variants.

## When to use

Use **Button** for actions that change state, submit forms, or open dialogs. For navigation inside prose, prefer [Link](link.md). Pair destructive actions with clear labels (`Delete workspace`, not `OK`).

## Guidelines

**Do**

- Use `variant="primary"` for the single main action on a screen.
- Set `loading` during async work so users cannot double-submit.
- Give icon-only buttons an `aria-label`.

**Don't**

- Stack multiple primary buttons in one toolbar.
- Use `appearance="link"` when a plain [Link](link.md) fits better in body copy.
- Rely on colour alone — label the action in text.

## Usage

```twig
<twig:Button variant="primary">Save changes</twig:Button>
```

Previews below follow Bootstrap-style grouped sections: variants, appearances, sizes, and states.

## Variants

Solid semantic colours render together in one preview strip.

## Outline buttons

Outline appearance for every semantic colour.

## Soft appearance

Soft appearance strip for integrators comparing weight without outline borders.

## Ghost appearance

Ghost buttons for low-emphasis actions on dense surfaces.

## Link appearance

Link-styled buttons for inline actions — prefer [Link](link.md) in prose when navigation is the goal.

## Sizes

Small, medium, and large controls share the same variant defaults.

## Disabled states

Disabled buttons remove activation while preserving layout.

## Loading states

Loading implies disabled and shows a spinner during async work.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `primary` | Semantic colour: `primary`, `secondary`, `accent`, `success`, `danger`, `info`, `warning`, `neutral` |
| `appearance` | `string` | `solid` | Visual weight: `solid`, `soft`, `outline`, `ghost`, `link` |
| `size` | `string` | `md` | `sm`, `md`, `lg` |
| `as` | `string` | `button` | `button` or `a` for link-styled navigation |
| `href` | `string` | `#` | Destination when `as="a"` |
| `disabled` | `bool` | `false` | Removes activation |
| `loading` | `bool` | `false` | Shows spinner; implies disabled |
| `block` | `bool` | `false` | Full-width layout |
| `icon` | `string?` | — | Icon id (e.g. `tabler:plus`) |
| `iconPosition` | `string` | `start` | `start` or `end` |

Native attributes (`type`, `form`, `aria-*`, …) pass through on the component tag.

## Accessibility

- Icon-only buttons need visible text or `aria-label`.
- `loading` and `disabled` remove activation; do not depend on click handlers alone.
- Link mode needs a meaningful `href`, not `#`, unless you handle navigation in script.

## Related

- [Link](link.md) · [ButtonGroup](https://docs.symfinity.dev/ux-blocks-core/components) (README)
- [Input](https://docs.symfinity.dev/ux-blocks-form/components/input) — form fields

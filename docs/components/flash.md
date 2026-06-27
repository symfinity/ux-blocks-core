# Flash

Inline status message with semantic colour, optional icon, and CSS-only dismiss.

## When to use

Use **Flash** for transient feedback after an action (saved, warning, error). Prefer [FlashStack](flash-stack.md) when multiple messages can appear at once. For persistent page-level alerts with actions, use extended [Alert](https://docs.symfinity.dev/ux-blocks-extended/components/alert).

## Guidelines

**Do**

- Pair `variant` with explicit message text — never colour alone.
- Let `danger` persist until dismissed; success/info can auto-dismiss (default 5s).
- Use `icon` override only when the default variant icon is wrong for context.

**Don't**

- Stack many simultaneous Flash components — use FlashStack.
- Flash errors without a recovery path or next step.
- Hide critical text inside `title` only; body copy should stand alone.

## Usage

```twig
<twig:Flash variant="success">Profile saved.</twig:Flash>
```

Previews below follow variant groupings from [Bootstrap alerts](https://getbootstrap.com/docs/5.3/components/alerts/) (dismiss + semantic colour).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `info` | Semantic colour: `info`, `success`, `warning`, `danger` |
| `placement` | `string` | `top` | Layout anchor for stacked contexts |
| `dismissAfter` | `int?` | — | Auto-dismiss seconds; `null` = 5s (non-danger) or persist (`danger`) |
| `icon` | `string?` | — | Icon id override; empty string hides icon |
| `iconDecorative` | `bool` | `true` | When true, icon is `aria-hidden` |
| `iconWatermark` | `string?` | — | Decorative background watermark icon |
| `watermarkPosition` | `string` | `top-end` | Watermark placement when `iconWatermark` is set |

Default slot: message body. `title` prop available for emphasised heading line.

## Accessibility

- `danger` uses `role="alert"`; other variants use `role="status"`.
- Do not rely on colour alone — message text must convey meaning.
- Dismiss control is keyboard reachable; collapsed reflow respects reduced motion.

## Related

- [FlashStack](flash-stack.md) · [Alert](https://docs.symfinity.dev/ux-blocks-extended/components/alert)

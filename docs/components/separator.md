# Separator

Visual divider between sections.

## When to use

Visual divider between sections. Use **Separator** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Prefer kernel spacing tokens (`gap`, `stack`) over ad-hoc margins.
- Keep nesting shallow — compose with Stack or Grid.

**Don't**

- Wrap every block in multiple layout shells.
- Fight the theme spacing scale with one-off pixel values.

## Usage

```twig
<twig:Separator />
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `orientation` | `string` | `horizontal` | `horizontal` or `vertical` |
| `decorative` | `bool` | `true` | When false, exposes `role="separator"` for assistive tech |

## Accessibility

- Preserve document heading order inside layout regions.
- Scroll areas need keyboard access to overflowing content.

## Related

- [Stack](stack.md)

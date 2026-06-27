# Divider

Text or rule divider for inline separation.

## When to use

Text or rule divider for inline separation. Use **Divider** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Prefer kernel spacing tokens (`gap`, `stack`) over ad-hoc margins.
- Keep nesting shallow — compose with Stack or Grid.

**Don't**

- Wrap every block in multiple layout shells.
- Fight the theme spacing scale with one-off pixel values.

## Usage

```twig
<twig:Divider />
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Preserve document heading order inside layout regions.
- Scroll areas need keyboard access to overflowing content.

## Related

- [Separator](separator.md)

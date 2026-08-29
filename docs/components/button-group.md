# ButtonGroup

Grouped related buttons.

## When to use

Grouped related buttons. Use **ButtonGroup** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Use one clear primary action per view.
- Match `variant` to semantic intent (danger for destructive).

**Don't**

- Stack multiple primary-weight controls side by side.
- Use buttons for plain navigation when Link fits.

## Usage

```twig
<twig:ButtonGroup>…</twig:ButtonGroup>
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Icon-only controls need `aria-label`.
- Do not rely on colour alone for meaning.

## Related

- [Button](button.md)

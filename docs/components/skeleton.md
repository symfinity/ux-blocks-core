# Skeleton

Loading placeholder shape.

## When to use

Loading placeholder shape. Use **Skeleton** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Pair status colour with visible text.
- Use dismiss controls only when users can recover context.

**Don't**

- Flash critical errors without a recovery action.
- Show loading placeholders without an eventual content swap.

## Usage

```twig
<twig:Skeleton class="h-8 w-48" />
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Status messages need text — not colour alone.
- Use `role="alert"` for urgent errors; `role="status"` for success/info.

## Related

- [Spinner](spinner.md)

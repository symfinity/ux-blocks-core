# Progress

Determinate progress bar with semantic colour variant.

## When to use

Use **Progress** when you know completion percentage (upload, multi-step wizard). For indeterminate waits without a percent, prefer [Spinner](spinner.md) or skeleton placeholders.

## Guidelines

**Do**

- Set `value` and `max` so assistive tech can announce percent complete.
- Keep `max` stable for the operation — do not change mid-flight without resetting `value`.
- Use `variant` for semantic emphasis (`danger` on failure paths) sparingly.

**Don't**

- Show 0–100% for unknown-duration work — use indeterminate patterns instead.
- Animate the bar without respecting `prefers-reduced-motion` (kernel handles reduced motion).

## Usage

```twig
<twig:Progress variant="primary" :value="42" :max="100" />
```

Compare with [Bootstrap progress](https://getbootstrap.com/docs/5.3/components/progress/) and [Material linear progress](https://m3.material.io/components/progress-indicators).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `primary` | Semantic colour token |
| `value` | `int` | `0` | Current progress |
| `max` | `int` | `100` | Maximum value |

## Accessibility

- Exposes `role="progressbar"` with `aria-valuenow`, `aria-valuemin`, `aria-valuemax`.
- Pair with visible status text when percent alone is insufficient context.

## Related

- [Spinner](spinner.md) · [Skeleton](skeleton.md)

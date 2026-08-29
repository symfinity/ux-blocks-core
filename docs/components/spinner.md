# Spinner

Animated loading indicator with optional visible label.

## When to use

Show that content or an action is in progress. Pair with [Button](button.md) `loading` when the trigger stays on screen, or [Skeleton](skeleton.md) when layout shape is known.

## Guidelines

**Do**

- Provide `label` text for screen readers even when the spinner is visually small.
- Use one spinner per region — avoid multiple spinners on the same view.
- Replace the spinner with content or an error state when work finishes.

**Don't**

- Block the entire page for fast operations (&lt;300ms).
- Use spinners without any status text for long-running tasks.

## Usage

```twig
<twig:Spinner label="Loading workspace" />
```

Similar to [Bootstrap spinners](https://getbootstrap.com/docs/5.3/components/spinners/).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `Loading` | Accessible name |
| `size` | `string` | `md` | `sm`, `md`, `lg` |
| `variant` | `string` | `primary` | Semantic colour |

## Accessibility

- `label` is exposed to assistive technology.
- Do not rely on motion alone — announce completion when loading ends.

## Related

- [Progress](progress.md) · [Skeleton](skeleton.md) · [Button](button.md)

# Badge

Compact label for status, counts, and categories.

## When to use

Surface metadata (`New`, `Beta`, `3 unread`) beside headings or in tables. Not for navigation — use [Link](link.md) or [Button](button.md).

## Guidelines

**Do**

- Keep copy short (one or two words).
- Pick `variant` to match semantic meaning (`success` for active, `neutral` for version tags).

**Don't**

- Use badges as the only indicator of critical state — add visible text.
- Make badges clickable without a real link or button wrapper.

## Usage

```twig
<twig:Badge variant="success">Active</twig:Badge>
```

Similar to [Bootstrap badges](https://getbootstrap.com/docs/5.3/components/badge/) and [shadcn Badge](https://ui.shadcn.com/docs/components/badge).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `primary` | Semantic colour palette |
| `size` | `string` | `md` | `sm`, `md`, `lg` |
| `icon` | `string?` | — | Icon before label text |

## Accessibility

- Badges are static text — not interactive by default.
- Screen readers announce badge content with surrounding context.

## Related

- [Button](button.md) · [Link](link.md)

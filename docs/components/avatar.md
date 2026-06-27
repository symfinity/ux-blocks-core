# Avatar

Circular identity marker — initials, icon, or image inside a sized frame.

## When to use

Show a person, team, or entity in lists, comments, and nav chrome. Pair with [Badge](badge.md) for status, not as the only identity signal in critical flows.

## Guidelines

**Do**

- Use initials when no photo is available.
- Pick `size` to match surrounding text (`sm` in tables, `lg` in profile headers).
- Keep `variant` aligned with the active semantic palette.

**Don't**

- Rely on avatar colour alone to distinguish users.
- Stretch or crop photos without a consistent aspect ratio.

## Usage

```twig
<twig:Avatar size="default" variant="primary">AB</twig:Avatar>
```

Comparable patterns: [shadcn Avatar](https://ui.shadcn.com/docs/components/avatar).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `primary` | Semantic colour ring / background |
| `size` | `string` | `default` | `sm`, `default`, `lg` |

Default slot: initials or short text inside the frame.

## Accessibility

- When the avatar identifies a person, expose the name in surrounding text or `aria-label` on a parent control.
- Decorative avatars in repeating lists may use `alt=""` on nested images when you add image support.

## Related

- [Badge](badge.md) · [Image](image.md)

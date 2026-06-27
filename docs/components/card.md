# Card

Container for grouped content with optional header, media, body, footer, and actions.

## When to use

Use **Card** for grouped content that needs a surface, title, or footer actions. Cards compose with [Button](button.md) and typography roles from this package.

## Guidelines

**Do**

- Keep titles concise; put detail in the body slot.
- Use `tone="muted"` for secondary panels.
- Limit primary actions in the footer to one main button.

**Don't**

- Nest cards deeply without clear hierarchy.
- Use cards as purely decorative wrappers with no structure.

## Usage

```twig
<twig:Card title="Notifications" description="Manage delivery preferences.">
    Email digest weekly.
</twig:Card>
```

## Basic card

Title, optional description, and default body slot.

## Header / footer variants

Cards with composed footer actions using nested components in the slot.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `title` | `string?` | — | Header title |
| `description` | `string?` | — | Header supporting text |
| `size` | `string` | `md` | Density preset |
| `density` | `string` | `comfortable` | Internal spacing |
| `tone` | `string` | `default` | Surface emphasis |

## Related

- [Button](button.md)
- [SectionHeading](section-heading.md)

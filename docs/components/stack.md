# Stack

Spaces a list of items in one direction.

## When to use

| Direction | Use it for |
|-----------|------------|
| `vertical` | Sections, form fields, and anything that should read top to bottom. |
| `horizontal` | Page columns. The row starts only when the stack is at least 48rem wide. Narrower than that, it stays a column. |
| `inline` | Badge rows, tag lists, and button clusters. Items sit on one wrapping line at every width. |

## Guidelines

**Do**

- Use `inline` for short items that should stay in a row inside a narrow card.
- Use `horizontal` when the row is a page column that should stack on a small screen.
- Pick `gap` from the spacing scale (`xs`, `sm`, `md`, `lg`).

**Don't**

- Use `horizontal` and then add your own wrapping-row CSS for badges.
- Nest stacks to create a grid. Use [Grid](grid.md).

## Usage

```twig
<twig:Stack direction="vertical" gap="md">
    <twig:Typography>Title</twig:Typography>
    <twig:Typography variant="muted">Supporting line</twig:Typography>
</twig:Stack>
```

A wrapping badge row:

```twig
<twig:Stack direction="inline" gap="sm">
    <twig:Badge>Draft</twig:Badge>
    <twig:Badge variant="neutral">EN</twig:Badge>
    <twig:Badge variant="accent">New</twig:Badge>
</twig:Stack>
```

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `direction` | `string` | `vertical` | `vertical`, `horizontal`, or `inline`. Any other value is treated as `vertical`. |
| `gap` | `string` | `md` | Space between items. |
| `density` | `string` | `comfortable` | `compact`, `comfortable`, or `spacious`. |
| content | block | — | The stacked items. |

## Accessibility

- Stack only changes layout. Heading order inside it stays the document order.
- Do not rely on a horizontal row to convey meaning that the reading order does not.

## Related

- [Grid](grid.md)
- [Badge](badge.md)

# PageHeading

Primary page title block.

## When to use

Primary page title block. Use **PageHeading** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Use one `h1` / PageHeading per view.
- Reserve muted/lead variants for hierarchy, not body copy only.

**Don't**

- Skip heading levels for styling convenience.
- Use headings for non-structural emphasis.

## Usage

```twig
<twig:PageHeading title="Settings" />
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `size` | `string` | — | Component attribute |
| `title` | `string?` | — | Slot or scalar content |
| `description` | `string?` | — | Slot or scalar content |
| `icon` | `string?` | — | Slot or scalar content |

## Accessibility

- Heading order must reflect page structure.
- Kbd hints should not be the only way to discover shortcuts.

## Related

- [SectionHeading](section-heading.md)

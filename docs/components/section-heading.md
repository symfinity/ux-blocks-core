# SectionHeading

Section title within a page.

## When to use

Section title within a page. Use **SectionHeading** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Use one `h1` / `SectionHeading level="1"` per view.
- Reserve muted/lead variants for hierarchy, not body copy only.

**Don't**

- Skip heading levels for styling convenience.
- Use headings for non-structural emphasis.

## Usage

```twig
<twig:SectionHeading level="1" title="Dashboard" description="Welcome back." />
<twig:SectionHeading title="Notifications" />
```

Actions in the `actions` block wrap onto the next line when the row is narrow. A level 1 title uses the larger size, including when the theme does not define the larger font tokens.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `level` | `int\|string` | `2` | Heading level `1`–`6` or `h1`–`h6`; use `1` for page title |
| `rhythm` | `string` | — | Set `baseline` for baseline rhythm scope |
| `title` | `string?` | — | Slot or scalar content |
| `description` | `string?` | — | Slot or scalar content |
| `icon` | `string?` | — | Slot or scalar content |

## Accessibility

- Heading order must reflect page structure.
- Kbd hints should not be the only way to discover shortcuts.

## Related

- [Breadcrumb](breadcrumb.md)

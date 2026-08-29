# Typography

Headings, body copy, and prose blocks.

## When to use

Headings, body copy, and prose blocks. Use **Typography** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Use one `h1` / [SectionHeading](section-heading.md) with `level="1"` per view.
- Reserve muted/lead variants for hierarchy, not body copy only.

**Don't**

- Skip heading levels for styling convenience.
- Use headings for non-structural emphasis.

## Usage

```twig
<twig:Typography as="h1">Page title</twig:Typography>
```


## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Heading order must reflect page structure.
- Kbd hints should not be the only way to discover shortcuts.

## Related

- [Button](button.md)

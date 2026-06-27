# Pagination

Paged navigation control.

## When to use

Paged navigation control. Use **Pagination** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Mark the current page in breadcrumbs and pagination.
- Keep link text descriptive out of context.

**Don't**

- Duplicate primary nav in breadcrumbs and navbar.
- Use `#` hrefs for real destinations.

## Usage

```twig
<twig:Pagination :page="1" :total="10" />
```


Comparable patterns: [Bootstrap pagination](https://getbootstrap.com/docs/5.3/components/pagination/).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Current page should be indicated with `aria-current`.
- Pagination controls need discernible names.

## Related

- [Button](button.md)

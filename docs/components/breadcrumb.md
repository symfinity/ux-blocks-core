# Breadcrumb

Hierarchical trail showing where the user is in the site structure.

## When to use

Deep navigation trees (docs, settings, admin). Skip breadcrumbs on shallow apps with a single primary nav.

## Guidelines

**Do**

- Mark the current page as non-link text (last item).
- Keep segment labels short but meaningful out of context.
- Mirror the real URL hierarchy when possible.

**Don't**

- Duplicate the full primary navbar in breadcrumbs.
- Use `#` hrefs for intermediate crumbs that are not real routes.

## Usage

```twig
<twig:Breadcrumb>
    <twig:BreadcrumbItem href="/">Home</twig:BreadcrumbItem>
    <twig:BreadcrumbItem href="/docs">Docs</twig:BreadcrumbItem>
    <twig:BreadcrumbItem current>Components</twig:BreadcrumbItem>
</twig:Breadcrumb>
```

Follows [Bootstrap breadcrumb](https://getbootstrap.com/docs/5.3/components/breadcrumb/) landmarks.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | Compose with `BreadcrumbItem` children |

Items support `href` for links and `current` for the active page.

## Accessibility

- Wrap in `<nav aria-label="Breadcrumb">` (provided by the component shell).
- Current page should use `aria-current="page"`.

## Related

- [Link](link.md) · [Navbar](https://docs.symfinity.dev/ux-blocks-extended/components/navbar)

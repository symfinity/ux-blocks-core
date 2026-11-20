# Pagination

A navigation row for moving between pages of a list.

## When to use

Use **Pagination** when a list is split into pages and the visitor needs previous, next, and numbered links. The component is a `<nav>` with one content block. You supply the links.

## Guidelines

**Do**

- Mark the current page with `aria-current="page"`.
- Keep the control to a short set of links.

**Don't**

- Put the page links in the navbar as well.
- Use `#` as the address of a real page.

## Usage

Pagination has no public props. Everything inside it is the content block.

```twig
<twig:Pagination>
    <twig:Button variant="primary" appearance="outline" size="sm">Previous</twig:Button>
    <twig:Button variant="primary" size="sm">2</twig:Button>
    <twig:Button variant="primary" appearance="outline" size="sm">Next</twig:Button>
</twig:Pagination>
```

The same slot can hold links instead of buttons:

```twig
<twig:Pagination>
    {% block content %}
        <twig:Link href="/page/1">1</twig:Link>
        <twig:Link href="/page/2">2</twig:Link>
    {% endblock %}
</twig:Pagination>
```

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| content | block | — | Previous, current, and next controls. Rendered inside the `<nav>`. |

## Accessibility

- The root is a `<nav>`. Give it an accessible name when the page has more than one navigation landmark.
- The current page needs `aria-current="page"`.

## Related

- [Button](button.md)
- [Link](link.md)

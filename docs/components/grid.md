# Grid

A CSS grid shell. Cells are the nested `Grid:Cell` component.

## When to use

Use **Grid** when items should line up in columns. Use [Stack](stack.md) when items only need to follow one another.

## Guidelines

**Do**

- Set `columns` to the count you want at a comfortable width.
- Put each item in `Grid:Cell`. Use `span` when one item should cover more than one column.

**Don't**

- Nest several grids to fake a simple stack.
- Set a pixel gap on the cells. Use `density` instead.

## Usage

```twig
<twig:Grid :columns="2" density="comfortable">
    <twig:Grid:Cell>First</twig:Grid:Cell>
    <twig:Grid:Cell>Second</twig:Grid:Cell>
</twig:Grid>
```

A cell can span columns:

```twig
<twig:Grid :columns="3">
    {% block content %}
        <twig:Grid:Cell :span="2">Wide</twig:Grid:Cell>
        <twig:Grid:Cell>Narrow</twig:Grid:Cell>
    {% endblock %}
</twig:Grid>
```

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `columns` | `int` or null | null | Column count, written as `data-ui-columns`. Omit it to leave the count to CSS. |
| `density` | `string` | `comfortable` | `compact`, `comfortable`, or `spacious`. |
| content | block | — | The cells. |

`Grid:Cell` props:

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `span` | `int` or null | null | How many columns this cell covers (`data-ui-span`). |
| content | block | — | The cell body. |

## Accessibility

- Keep heading order inside the cells the same as the reading order.
- Do not put the only page navigation inside a grid cell without a name.

## Related

- [Stack](stack.md)

# Link

Text navigation with semantic colour and optional icons.

## When to use

Inline navigation in prose, tables, and cards. For primary actions or submits, use [Button](button.md).

## Guidelines

**Do**

- Write descriptive link text (`View invoice`, not `Click here`).
- Set `external` for off-site URLs.
- Use `appearance="ghost"` for subtle toolbar links.

**Don't**

- Style every inline `<a>` as a button — reserve [Button](button.md) for actions.
- Use `#` as `href` for real navigation targets.

## Usage

```twig
<twig:Link href="/docs">Documentation</twig:Link>
```

External-link affordance follows [Material link](https://m3.material.io/components/buttons/guidelines) and [shadcn](https://ui.shadcn.com/docs/components/button#link) patterns.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `href` | `string` | `#` | Destination |
| `variant` | `string` | `primary` | Semantic colour |
| `appearance` | `string` | `link` | `solid`, `soft`, `outline`, `ghost`, `link` |
| `external` | `bool` | `false` | External icon + hints |
| `icon` | `string?` | — | Override default icon |

## Accessibility

- Use meaningful link text.
- Set `aria-current="page"` on active nav items via native attributes.
- External links should announce that they open a new context when applicable.

## Related

- [Button](button.md) · [Badge](badge.md)

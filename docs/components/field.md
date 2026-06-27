# Field

Form field wrapper with label, control slot, hint, and validation messaging.

## When to use

Use **Field** to associate a label, optional hint, and error text with a form control such as [Input](https://docs.symfinity.dev/ux-blocks-form/components/input). Prefer one Field per control for screen-reader parity.

## Guidelines

**Do**

- Pass meaningful `label` text.
- Surface validation with `error` or `invalid` together.
- Keep hints short and optional.

**Don't**

- Nest multiple controls without a fieldset legend.
- Rely on placeholder text instead of labels.

## Usage

```twig
<twig:Field label="Email">
    <twig:Input type="email" placeholder="you@example.com" />
</twig:Field>
```

## Default

Vertical label-control layout with associated `for` / `id` wiring.

## Disabled

Disabled controls remain visible with muted interaction.

## Invalid / validation

Invalid fields expose `role="alert"` error text and invalid styling on the control.

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string?` | — | Visible label text |
| `hint` | `string?` | — | Optional helper copy |
| `error` | `string?` | — | Validation message |
| `invalid` | `bool` | `false` | Forces invalid state |
| `orientation` | `string` | `vertical` | `vertical` or `horizontal` |

## Related

- [Input](https://docs.symfinity.dev/ux-blocks-form/components/input)
- [Button](button.md)

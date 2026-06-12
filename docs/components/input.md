# input

**Role:** `input`  
**Fragment id:** `blocks.input`

Native `<input>` styled via ui-kernel shared form-control rules (`[data-ui-role="input"]`).

## Props

| Prop | Type | Default | Notes |
|------|------|---------|-------|
| `type` | string | `text` | Closed catalog enum: `text`, `email`, `password`, `search`, `tel`, `url`, `number` |
| `placeholder` | string \| null | `null` | Optional hint text — not a substitute for `<label for="…">` |
| `invalid` | bool | `false` | Sets `aria-invalid="true"` + `data-ui-state="invalid"` |
| `disabled` | bool | `false` | Sets `disabled` + `data-ui-state="disabled"` |

Pass `name`, `id`, `autocomplete`, `required`, and other native attributes through Twig `attributes` (or HTML attributes on the component tag).

## Composition (recommended)

shadcn / ux-toolkit model pairs **Input** with a sibling **Label** (or `Field` / `Field:Label`):

```twig
<twig:Label for="email">Email address</twig:Label>
<twig:Input id="email" name="email" type="email" placeholder="you@example.com" />
```

Use matching `for` / `id`. Do not rely on `placeholder` alone when a visible label is required.

## REF note

ux-toolkit `kits/shadcn/input/` — leaf component; no nested templates. Variant/size live on `Field` or layout wrappers, not on atomic `Input`.

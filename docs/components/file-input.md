# file-input

**Role:** `file-input`  
**Fragment id:** `blocks.file-input`

Native `<input type="file">` styled via ui-kernel `[data-ui-role="file-input"]` rules (shared form-control border, `::file-selector-button`, disabled/invalid states).

## Props

| Prop | Type | Default | Notes |
|------|------|---------|-------|
| `disabled` | bool | `false` | Sets `disabled` + `data-ui-state="disabled"` |
| `invalid` | bool | `false` | Sets `aria-invalid="true"` + `data-ui-state="invalid"` |

Pass `accept`, `multiple`, `name`, and `id` through Twig `attributes` (or HTML attributes on the component tag).

## Composition (recommended)

shadcn / ux-toolkit model file upload as **Input `type="file"` inside Field + Label**. Chameleon keeps a dedicated `file-input` role; pair it with **`Label`** (or `Field` with scalar `label`) in real forms:

```twig
<twig:Label for="picture">Picture</twig:Label>
<twig:FileInput id="picture" name="picture" accept="image/*" />
```

Use matching `for` / `id` — do not rely on `aria-label` when a visible label is present.

Optional help copy: add `Field:Description` under a `Field` wrapper when you adopt the extended field pattern.

## REF note

ux-toolkit shadcn kit has no separate file-input recipe — see `input/examples/File.html.twig` (`<twig:Input type="file" />`). Registry role `file-input` is intentional for Chameleon catalog and kernel CSS.

# textarea

**Role:** `textarea`  
**Fragment id:** `blocks.textarea`

Native `<textarea>` with optional `content` slot for default value text.

## Props

| Prop | Type | Default | Notes |
|------|------|---------|-------|
| `placeholder` | string \| null | `null` | Optional hint — not a substitute for `<label for="…">` |
| `invalid` | bool | `false` | Sets `aria-invalid="true"` + `data-ui-state="invalid"` |
| `disabled` | bool | `false` | Sets `disabled` + `data-ui-state="disabled"` |

## Composition (recommended)

Pair with **Label** (or `Field:Label`) in real forms:

```twig
<twig:Label for="message">Message</twig:Label>
<twig:Textarea id="message" name="message" placeholder="Tell us more…">
    Default body copy when needed.
</twig:Textarea>
```

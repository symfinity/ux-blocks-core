# Reference

## Role registry

Authoritative role list: `config/ux_roles.yaml` (prefix `blocks.core.*`).

Handbook component pages: `docs/components/{role}.md` + `config/component-examples/{role}.yaml` (prefer `groups[]` — see [symfinity-docs grouped examples](https://github.com/symfinity/symfinity/blob/main/packages/symfinity-docs/docs/grouped-component-examples.md)).

## CSS layout

```text
assets/scss/          # author SCSS (mono-sass pipeline)
assets/styles/        # generated role CSS (headers mark generated)
```

Kernel emits tokens only; tier packages own role selectors in their committed CSS.

## Composition language

Universal region components (`SectionHeading`, composition regions, …) and `#[UxBlock]` attributes — see component handbook pages under `docs/components/`.

## Split-repo anchors

| Area | Path |
|------|------|
| Twig components | `src/Twig/Components/` |
| Stimulus | `assets/controllers/` |
| Role CSS | `assets/styles/` |

## Related

| Package | Role |
|---------|------|
| `symfinity/ux-blocks` | Registry + install profiles |
| `symfinity/ux-blocks-extended` | Extended tier roles |
| `symfinity/ux-blocks-form` | Form tier |
| `symfinity/ux-blocks-kiosk` | Dev showroom (`/kiosk`) |

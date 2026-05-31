# Porting reference — symfony/ux-toolkit shadcn

**Feature:** symfinity 003 — ux-component-catalog  
**Contract:** [port-semantics-ref](../../../../specs/symfinity/symfinity/3-ux-component-catalog/contracts/port-semantics-ref.md)

## REF checkout (read-only)

| Item | Value |
|------|-------|
| Repository | https://github.com/symfony/ux-toolkit |
| Branch | `3.x` |
| Kit folder | `kits/shadcn/` only |
| Pinned revision | `3.x` @ 2026-05-30 (re-pin before bulk re-port) |

Local maintainer paths (not committed):

```bash
git clone --depth 1 --branch 3.x https://github.com/symfony/ux-toolkit.git var/ref/ux-toolkit
# templates: var/ref/ux-toolkit/kits/shadcn/{slug}/templates/components/
```

**MUST NOT** vendor `kits/` into `packages/ux-blocks-core/`.

## Port transform

1. Copy Twig shape and `@prop` defaults from REF.
2. Remove `html_cva`, `|tailwind_merge`, utility class strings.
3. Set `data-ui-role` + `data-ui-fragment` on component root.
4. Map variant props → `data-ui-variant` / `data-ui-state`.
5. Add thin `#[AsTwigComponent]` PHP class mirroring REF props.

Product targets Symfony **7.4.\***, UX **2.\*** — port markup, not Toolkit Composer graph.

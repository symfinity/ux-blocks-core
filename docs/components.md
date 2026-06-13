# Components

## Interaction profile

| Token | Meaning in core |
|-------|-----------------|
| `nat` | Native HTML + ui-kernel / package CSS — default for every role |
| `act` | Declarative ui-action on `Button` only |
| `stl` | Not in this package — see `symfinity/ux-blocks-extended` |
| `live` | Not in this package — lab / app demos only |

Fragment prefix for this package: **`blocks`** (example: `blocks.button`, `blocks.input`).

## Component index

| Role | Twig | Interaction | Handbook |
|------|------|-------------|----------|
| typography | Typography | nat | [Typography](components/typography.md) |
| button | Button | nat, act | [Button](components/button.md) |
| label | Label | nat | [Label](components/label.md) |
| input | Input | nat | [Input](components/input.md) |
| textarea | Textarea | nat | [Textarea](components/textarea.md) |
| checkbox | Checkbox | nat | [Checkbox](components/checkbox.md) |
| radio-group | RadioGroup | nat | [Radio group](components/radio-group.md) |
| select | Select | nat | [Select](components/select.md) |
| switch | Switch | nat | — |
| file-input | FileInput | nat | [File input](components/file-input.md) |
| separator | Separator | nat | [Separator](components/separator.md) |
| divider | Divider | nat | — |
| aspect-ratio | AspectRatio | nat | — |
| scroll-area | ScrollArea | nat | — |
| badge | Badge | nat | — |
| progress | Progress | nat | — |
| spinner | Spinner | nat | [Spinner](components/spinner.md) |
| skeleton | Skeleton | nat | — |
| empty | Empty | nat | [Empty](components/empty.md) |
| avatar | Avatar | nat | — |
| image | Image | nat | [Image](components/image.md) |
| figure | Figure | nat | — |
| kbd | Kbd | nat | — |
| link | Link | nat | — |

The README component table is the semver inventory SSOT; this page adds handbook links where depth pages exist.

## Using components

Twig tag name matches the **Twig** column (`<twig:Button>`, `<twig:Input>`, …). Nested roles (for example `RadioGroup:Item`, `Empty:Title`) are documented on the parent role page.

Install sibling tiers when you need overlays, marketing sections, or shop blocks:

| Package | Fragment prefix |
|---------|-----------------|
| `symfinity/ux-blocks-core` | `blocks.*` |
| `symfinity/ux-blocks-extended` | `blocks.ext.*` |
| `symfinity/ux-blocks-marketing` | `blocks.marketing.*` |
| `symfinity/ux-blocks-ecommerce` | `blocks.shop.*` |

See [Quick start](quickstart.md) for a minimal template.

## Family navigation

- [Installation](installation.md) — Flex and dependencies
- [Configuration](configuration.md) — routes and auto-wiring
- [Upgrade](upgrade.md) — version migrations

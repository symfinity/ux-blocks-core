# Usage

Patterns after [Installation](installation.md) and [Quick start](quickstart.md) for day-to-day UX Blocks Core work.

## Render a component

Twig tag name matches the registry **Twig** column (`Button`, `Input`, …):

```twig
<twig:Button variant="primary">Save</twig:Button>
<twig:Input id="email" name="email" type="email" />
```

Each root element exposes `data-ui-role`, `data-ui-fragment` (`blocks.*`), and UI Kernel variant hooks. See [Components](components.md) for the full index.

## Theme CSS requirement

Components assume [symfinity/ui-kernel](https://github.com/symfinity/ui-kernel) theme CSS on the page:

```twig
{{ ui_kernel_theme_boot_script() }}
{{ ui_kernel_css()|raw }}
```

Without kernel CSS, atoms render unstyled HTML.

## Dev catalog route

When enabled in [Configuration](configuration.md), open `/ux-blocks-core/catalog` in **dev** to browse registered roles locally.

## Per-role handbooks

Depth pages live under [docs/components/](components/) — start with [Button](components/button.md) and [Input](components/input.md).

## See also

- [Quick start](quickstart.md) — minimal layout example
- [Upgrade](upgrade.md) — semver migrations

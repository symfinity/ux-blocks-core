# Usage

Day-to-day patterns for **symfinity/ux-blocks-core**.

## Start here

**[Button](components/button.md)** — variants, appearances, and live previews for the most common interactive control.

Form fields (**Input**, **Field**, **Select**, …) are documented in **[symfinity/ux-blocks-form](https://packagist.org/packages/symfinity/ux-blocks-form)**.

## Render a component

Twig tag names match the component class (`Button`, `Spinner`, …):

```twig
<twig:Button variant="primary">Save</twig:Button>
<twig:Spinner label="Loading" />
```

## Theme CSS

Styled output needs UI Kernel theme CSS on the page:

```twig
{{ ui_kernel_theme_boot_script() }}
{{ ui_kernel_css()|raw }}
```

Without a theme, markup is still valid; visual tokens resolve once CSS loads.

## See also

- [Components](components.md) — core handbook index
- [Quick start](quickstart.md) — minimal layout
- [Installation](installation.md) — Flex and dependencies

# Quick start

Use UX Blocks Core components in a Symfony app with ui-kernel theme CSS.

## Prerequisites

[Installation](installation.md) completed — `symfinity/ui-kernel` and `symfinity/ux-blocks-core` installed (`symfinity/ux-blocks` from Packagist).

## 1. Include ui-kernel CSS

Components rely on ui-kernel design tokens and shared form-control rules. In your base layout `<head>`:

```twig
{# templates/base.html.twig #}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{% block title %}My app{% endblock %}</title>
    {{ ui_kernel_theme_boot_script() }}
    {{ ui_kernel_css()|raw }}
    {% block stylesheets %}{% endblock %}
</head>
<body>
    {% block body %}{% endblock %}
</body>
</html>
```

Minimal ui-kernel app config:

```yaml
# config/packages/symfinity_ui_kernel.yaml
symfinity_ui_kernel:
    default_theme: semantic
    default_variant: semantic
    schema_version: '1.0'
```

## 2. Render components

Use UX Twig component tags (Twig name = registry **Twig** column):

```twig
{# templates/demo.html.twig #}
<main style="padding: var(--ui-space-lg);">
    <twig:Typography as="h1">Account settings</twig:Typography>

    <twig:Label for="email">Email address</twig:Label>
    <twig:Input id="email" name="email" type="email" placeholder="you@example.com" />

    <twig:Button variant="default">Save changes</twig:Button>
    <twig:Button variant="outline">Cancel</twig:Button>
</main>
```

Each root element exposes `data-ui-role`, `data-ui-fragment`, and Chameleon variant hooks — see [Components](components.md).

## 3. Optional dev catalog

When routing is enabled, open `/ux-blocks-core/catalog` to preview registered roles (requires `APP_ENV=dev` or equivalent access control in your app).

## Complete minimal example

```yaml
# config/packages/symfinity_ui_kernel.yaml
symfinity_ui_kernel:
    default_theme: default
    default_variant: default
    schema_version: '1.0'
```

```twig
{# templates/onboarding.html.twig #}
<!DOCTYPE html>
<html lang="en">
<head>
    {{ ui_kernel_theme_boot_script() }}
    {{ ui_kernel_css()|raw }}
</head>
<body>
    <twig:Empty>
        <twig:block name="title">No projects yet</twig:block>
        <twig:block name="description">Create your first project to get started.</twig:block>
        <twig:Button variant="default">Create project</twig:Button>
    </twig:Empty>
</body>
</html>
```

## Next steps

- [Components](components.md) — full role inventory and fragment prefix
- [Configuration](configuration.md) — catalog route
- Per-role pages under [docs/components/](components/)

## See also

- [CHANGELOG](https://github.com/symfinity/ux-blocks-core/blob/main/CHANGELOG.md) — version history
- [Contributing](https://github.com/symfinity/ux-blocks-core/blob/main/CONTRIBUTING.md) — how to contribute
- [GitHub Issues](https://github.com/symfinity/ux-blocks-core/issues) — bug reports

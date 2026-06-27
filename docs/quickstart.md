# Quick start

Use UX Blocks Core in a Symfony app with UI Kernel theme CSS.

## Prerequisites

Complete [Installation](installation.md) — `symfinity/ui-kernel` and `symfinity/ux-blocks-core` installed.

## 1. Include theme CSS

In your base layout:

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

Minimal UI Kernel config:

```yaml
# config/packages/symfinity_ui_kernel.yaml
symfinity_ui_kernel:
    default_theme: semantic
    default_variant: semantic
    schema_version: '1.0'
```

## 2. Render components

```twig
<main style="padding: var(--ui-space-lg);">
    <twig:Typography as="h1">Account settings</twig:Typography>
    <twig:Typography as="p">Update your profile details below.</twig:Typography>

    <twig:Button variant="primary">Save changes</twig:Button>
    <twig:Button variant="secondary" appearance="outline">Cancel</twig:Button>
</main>
```

For form fields, add [symfinity/ux-blocks-form](https://packagist.org/packages/symfinity/ux-blocks-form) and use `Input`, `Field`, etc.

## Next steps

- [Components](components.md) — handbook index
- [Button](components/button.md) — variants and live previews
- [Configuration](configuration.md) — bundle wiring

## See also

- [CHANGELOG](https://github.com/symfinity/ux-blocks-core/blob/main/CHANGELOG.md)
- [Contributing](https://github.com/symfinity/ux-blocks-core/blob/main/CONTRIBUTING.md)

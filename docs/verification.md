# Verification

**Integration profile:** P2 — embed (Twig components + auto inline CSS).

Clean-app smoke below verifies that a fresh `composer require symfinity/ux-blocks-core` install renders styled components without manual tier CSS wiring.

## Local commands

```bash
composer test
composer phpstan
```

## Clean-app smoke

On a fresh Symfony 7.4+ project:

```bash
composer require symfinity/ux-blocks-core
```

Render `<twig:Button label="Save" />` in a template — expect:

- `data-ui-role="button"` in the response body
- `id="ux-blocks-core-css"` inline style (auto-injected once per request; no manual layout wiring)

Optional manual emit: `{{ ux_blocks_ui_assets()|raw }}` in `<head>`.

## See also

- [Quick start](quickstart.md)
- [CHANGELOG](../CHANGELOG.md)

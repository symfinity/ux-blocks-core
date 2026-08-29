# Console commands

`symfinity/ux-blocks-core` does not ship package-scoped console commands. Role CSS is committed under `assets/styles/` and loaded through AssetMapper — you do not compile Sass in a normal consumer app.

When you add custom roles in a fork, export registry YAML and keep `config/component-examples/{role}.yaml` in sync with handbook pages.

See [usage.md](usage.md) for Twig and AssetMapper wiring.

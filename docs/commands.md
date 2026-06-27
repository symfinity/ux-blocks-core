# Console commands

`symfinity/ux-blocks-core` does not ship package-scoped console commands. CSS compilation and QA hooks run through the **consumer monorepo** toolkit:

| Command | Purpose |
|---------|---------|
| `vendor/bin/mono sass:compile` | Compile author SCSS to role CSS (`symfinity/mono-sass`) |
| `vendor/bin/mono qa:lite` | Includes CSS selector coverage / freshness gates when configured |

In Symfinity product monorepos, `./bin/blocks-css-compile` orchestrates tier compiles before QA.

Registry export (maintainers):

```bash
vendor/bin/mono ux-blocks:registry-export
```

See [usage.md](usage.md) and the monorepo `mono.json` `docs` / QA blocks for project-specific wiring.

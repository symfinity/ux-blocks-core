# Troubleshooting

## Component renders unstyled

1. Require `symfinity/ui-kernel` and a theme pack — blocks CSS references kernel tokens.
2. Ensure tier CSS is compiled and AssetMapper maps `assets/` for `symfinity/ux-blocks-core`.
3. In dogfood dev, delete `public/assets/` if compiled output blocks live CSS.

## Live preview differs from kiosk / workshop

Handbook component pages use **SSR** with the handbook theme YAML. Kiosk and ux-workshop may use different theme injection — compare `data-ui-*` attributes and loaded stylesheets in the browser network panel.

## Registry / role not found

Run `vendor/bin/mono ux-blocks:registry-export` after adding roles under `config/ux_roles.yaml`. Component handbook pages expect `config/component-examples/{role}.yaml` for live examples.

## Strict handbook link check fails

`mono docs:compile --strict-links` fails on broken relative links in `docs/*.md`. Fix the source markdown or remove dead relative links before publish.

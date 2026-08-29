# Troubleshooting

## Component renders unstyled

1. Require `symfinity/ui-kernel` and a theme pack — blocks CSS references kernel tokens.
2. Ensure tier CSS is compiled and AssetMapper maps `assets/` for `symfinity/ux-blocks-core`.
3. In dev, delete `public/assets/` if you ran `asset-map:compile` and live CSS stops updating.

## Live preview differs from another app theme

Handbook component pages use **SSR** with the handbook theme YAML. Your app may use a different theme — compare `data-ui-*` attributes and loaded stylesheets in the browser network panel.

## Role not found in registry

After adding roles under `config/ux_roles.yaml`, clear Symfony cache and confirm the role id matches `data-ui-fragment` on the component root.

## Broken handbook links

Fix relative links in `docs/*.md` before publishing forked handbook slices — dead `./` links fail strict compile checks in downstream doc pipelines.

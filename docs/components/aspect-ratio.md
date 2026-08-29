# AspectRatio

Locks media to a fixed width/height ratio.

## When to use

Locks media to a fixed width/height ratio. Use **AspectRatio** when this pattern fits the screen — variant previews are below.

## Guidelines

**Do**

- Provide descriptive `alt` on informative images.
- Pick aspect ratios that match the media format.

**Don't**

- Stretch media without a ratio or max-width constraint.
- Use decorative images without `alt=""` when appropriate.

## Usage

```twig
<twig:AspectRatio ratio="16/9">…</twig:AspectRatio>
```


Comparable patterns: [Bootstrap ratio](https://getbootstrap.com/docs/5.3/helpers/ratio/).

## API Reference

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| — | — | — | See Twig component class and package registry. |

## Accessibility

- Informative images require text alternatives.
- Avatars need meaningful labels when they identify a person.

## Related

- [Image](image.md)

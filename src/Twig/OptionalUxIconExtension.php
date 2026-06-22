<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class OptionalUxIconExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('ux_blocks_icon', $this->renderIcon(...), [
                'is_safe' => ['html'],
                'needs_environment' => true,
            ]),
        ];
    }

    public function renderIcon(Environment $env, ?string $name): string
    {
        $name = null === $name ? '' : trim($name);
        if ('' === $name) {
            return '';
        }

        if (null === $env->getFunction('ux_icon')) {
            return '';
        }

        // ux_icon is a Twig *runtime* function — never invoke getCallable() directly.
        if (class_exists(\Symfony\UX\Icons\Twig\UXIconRuntime::class)) {
            try {
                $result = $env->getRuntime(\Symfony\UX\Icons\Twig\UXIconRuntime::class)->renderIcon($name);

                return \is_string($result) ? $result : '';
            } catch (\Twig\Error\RuntimeError) {
                // UX Icons runtime not registered on this Environment — fall back below.
            }
        }

        return trim($env->createTemplate('{% apply spaceless %}{{ ux_icon(icon) }}{% endapply %}')->render([
            'icon' => $name,
        ]));
    }
}

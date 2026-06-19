<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Showcase;

final class ComponentExampleViewFactory
{
    private const PARTIAL_MAP = [
        'showcase/_compounds/by_twig.html.twig' => '@UxBlocksCore/catalog/compounds/by_twig.html.twig',
        'showcase/_compounds/form_controls.html.twig' => '@UxBlocksCore/catalog/compounds/form_controls.html.twig',
        'showcase/_compounds/typography_variants.html.twig' => '@UxBlocksCore/catalog/compounds/typography_variants.html.twig',
        'showcase/_compounds/figure.html.twig' => '@UxBlocksCore/catalog/compounds/figure.html.twig',
        'showcase/_compounds/section_heading_shell.html.twig' => '@UxBlocksCore/catalog/compounds/section_heading_shell.html.twig',
        'showcase/_compounds/page_heading_shell.html.twig' => '@UxBlocksCore/catalog/compounds/page_heading_shell.html.twig',
        'showcase/_compounds/select_options.html.twig' => '@UxBlocksCore/catalog/compounds/select_options.html.twig',
        'showcase/_compounds/radio_group_demo.html.twig' => '@UxBlocksCore/catalog/compounds/radio_group_demo.html.twig',
        'showcase/_compounds/grid_demo.html.twig' => '@UxBlocksCore/catalog/compounds/grid_demo.html.twig',
        'showcase/_compounds/stack_demo.html.twig' => '@UxBlocksCore/catalog/compounds/stack_demo.html.twig',
        'showcase/_compounds/divider_context.html.twig' => '@UxBlocksCore/catalog/compounds/divider_context.html.twig',
        'showcase/_compounds/separator_context.html.twig' => '@UxBlocksCore/catalog/compounds/separator_context.html.twig',
        'showcase/_compounds/aspect_ratio_demo.html.twig' => '@UxBlocksCore/catalog/compounds/aspect_ratio_demo.html.twig',
        'showcase/_compounds/typography_scale.html.twig' => '@UxBlocksCore/catalog/compounds/typography_scale.html.twig',
        'showcase/_compounds/list_demo.html.twig' => '@UxBlocksCore/catalog/compounds/list_demo.html.twig',
        'showcase/_compounds/scroll_area_demo.html.twig' => '@UxBlocksCore/catalog/compounds/scroll_area_demo.html.twig',
        'showcase/_compounds/fieldset_demo.html.twig' => '@UxBlocksCore/catalog/compounds/fieldset_demo.html.twig',
        'showcase/_compounds/input_group_demo.html.twig' => '@UxBlocksCore/catalog/compounds/input_group_demo.html.twig',
        'showcase/_compounds/button_group_demo.html.twig' => '@UxBlocksCore/catalog/compounds/button_group_demo.html.twig',
    ];

    /**
     * @return array{
     *     role: string,
     *     twig_name: string,
     *     requires_stimulus: bool,
     *     sections: list<array<string, mixed>>
     * }
     */
    public function build(ComponentExampleManifest $manifest): array
    {
        $sections = [];
        foreach ($manifest->sections as $section) {
            $sections[] = $this->buildSection($section, $manifest);
        }

        return [
            'role' => $manifest->role,
            'twig_name' => $manifest->twigName,
            'requires_stimulus' => $manifest->requiresStimulus,
            'sections' => $sections,
        ];
    }

    /**
     * @param array<string, mixed> $section
     * @return array<string, mixed>
     */
    private function buildSection(array $section, ComponentExampleManifest $manifest): array
    {
        $layout = (string) ($section['layout'] ?? 'stack');
        $built = [
            'id' => (string) ($section['id'] ?? 'demo'),
            'title' => (string) ($section['title'] ?? 'Demo'),
            'layout' => $layout,
            'groups' => [],
            'items' => [],
        ];

        if (isset($section['groups']) && is_array($section['groups'])) {
            foreach ($section['groups'] as $group) {
                if (!is_array($group)) {
                    continue;
                }
                $built['groups'][] = [
                    'size' => (string) ($group['size'] ?? 'default'),
                    'label' => (string) ($group['label'] ?? ''),
                    'items' => $this->buildItems($group['items'] ?? [], $manifest),
                ];
            }
        }

        if (isset($section['items']) && is_array($section['items'])) {
            $built['items'] = $this->buildItems($section['items'], $manifest);
        }

        return $built;
    }

    /**
     * @param list<mixed> $items
     * @return list<array<string, mixed>>
     */
    private function buildItems(array $items, ComponentExampleManifest $manifest): array
    {
        $built = [];
        foreach ($items as $item) {
            if (!is_array($item)) {
                continue;
            }
            $built[] = $this->buildItem($item, $manifest);
        }

        return $built;
    }

    /**
     * @param array<string, mixed> $item
     * @return array<string, mixed>
     */
    private function buildItem(array $item, ComponentExampleManifest $manifest): array
    {
        $props = is_array($item['props'] ?? null) ? $item['props'] : [];
        foreach (['disabled', 'as', 'href', 'block'] as $key) {
            if (array_key_exists($key, $item)) {
                $props[$key] = $item[$key];
            }
        }

        $props = $this->applyRoleDefaults($manifest->role, $props);

        $partial = (string) ($item['render_partial'] ?? '');
        $mappedPartial = self::PARTIAL_MAP[$partial] ?? ($partial !== '' ? $partial : null);

        $slotText = (string) ($item['slot_text'] ?? $item['slot_content'] ?? $item['label'] ?? $manifest->twigName);
        if ($manifest->role === 'avatar' && !isset($item['slot_text']) && !isset($item['slot_content'])) {
            $slotText = 'SF';
        }

        return [
            'variant' => (string) ($item['variant'] ?? 'default'),
            'label' => (string) ($item['label'] ?? $manifest->twigName),
            'props' => $props,
            'slot_text' => $slotText,
            'has_slot' => $this->itemUsesSlot($manifest->twigName, $item),
            'render_partial' => $mappedPartial,
        ];
    }

    /**
     * @param array<string, mixed> $props
     * @return array<string, mixed>
     */
    private function applyRoleDefaults(string $role, array $props): array
    {
        return match ($role) {
            'breadcrumb' => $props + [
                'auto' => false,
                'items' => $props['items'] ?? [
                    ['label' => 'Home', 'url' => '/'],
                    ['label' => 'Components', 'url' => '/ux-blocks-core/catalog'],
                    ['label' => 'Breadcrumb', 'current' => true],
                ],
            ],
            'pagination' => $props + [
                'page' => $props['page'] ?? 2,
                'pages' => $props['pages'] ?? 5,
            ],
            'checkbox' => $props + [
                'id' => $props['id'] ?? 'catalog-checkbox-demo',
                'name' => $props['name'] ?? 'catalog-checkbox',
            ],
            'switch' => $props + [
                'id' => $props['id'] ?? 'catalog-switch-demo',
                'name' => $props['name'] ?? 'catalog-switch',
            ],
            'input', 'textarea', 'select', 'file-input' => $props + [
                'id' => $props['id'] ?? 'catalog-' . $role,
                'name' => $props['name'] ?? $role,
            ],
            'link' => $props + [
                'href' => $props['href'] ?? '#',
            ],
            'progress' => $props + [
                'value' => $props['value'] ?? 60,
                'max' => $props['max'] ?? 100,
            ],
            'image', 'figure' => $props + [
                'src' => $props['src'] ?? '/images/placeholder.svg',
                'alt' => $props['alt'] ?? 'Catalog placeholder',
            ],
            'flash' => $props + [
                // Catalog matrix must stay visible — do not auto-dismiss showcase cells.
                'dismissAfter' => array_key_exists('dismissAfter', $props) ? $props['dismissAfter'] : 0,
                // Suppress variant default icon names when unset — avoids empty icon gutters without ux-icons.
                'icon' => array_key_exists('icon', $props) ? $props['icon'] : '',
            ],
            default => $props,
        };
    }

    /**
     * @param array<string, mixed> $item
     */
    private function itemUsesSlot(string $twigName, array $item): bool
    {
        if (isset($item['slots']) && is_array($item['slots'])) {
            return true;
        }

        return !\in_array($twigName, [
            'Input',
            'Textarea',
            'Select',
            'Checkbox',
            'Switch',
            'FileInput',
            'Progress',
            'Separator',
            'Divider',
            'Skeleton',
            'Spinner',
            'Image',
            'ScrollArea',
            'AspectRatio',
        ], true);
    }
}

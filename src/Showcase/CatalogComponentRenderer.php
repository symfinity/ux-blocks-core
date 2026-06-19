<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Showcase;

use Twig\Environment;

/**
 * Renders catalog matrix cells with optional default slot content.
 *
 * Symfony UX only allows block slots with a literal {% component Name %} tag;
 * component() cannot pass {% block content %}.
 */
final class CatalogComponentRenderer
{
    /** @var list<string> */
    private const ALLOWED = [
        'AspectRatio',
        'Avatar',
        'Badge',
        'Breadcrumb',
        'Button',
        'ButtonGroup',
        'Checkbox',
        'Divider',
        'Fieldset',
        'Figure',
        'FileInput',
        'Flash',
        'Grid',
        'Image',
        'Input',
        'InputGroup',
        'Kbd',
        'Label',
        'Link',
        'List',
        'PageHeading',
        'Pagination',
        'Progress',
        'RadioGroup',
        'ScrollArea',
        'SectionHeading',
        'Select',
        'Separator',
        'Skeleton',
        'Spinner',
        'Stack',
        'Switch',
        'Textarea',
        'Typography',
    ];

    public function __construct(
        private readonly Environment $twig,
    ) {
    }

    /**
     * @param array<string, mixed> $props
     */
    public function render(string $twigName, array $props, ?string $slotText = null, bool $hasSlot = false): string
    {
        if (!\in_array($twigName, self::ALLOWED, true)) {
            throw new \InvalidArgumentException(sprintf('Catalog cannot render unknown component "%s".', $twigName));
        }

        $useSlot = $hasSlot && $slotText !== null && $slotText !== '';
        if (!$useSlot) {
            $source = sprintf('{%% component %s with props only %%}{%% endcomponent %%}', $twigName);

            return $this->twig->createTemplate($source)->render(['props' => $props]);
        }

        // Block bodies compile in component scope — outer {% set %} is not visible there.
        $literalSlot = htmlspecialchars($slotText, \ENT_NOQUOTES | \ENT_SUBSTITUTE, 'UTF-8');
        $source = sprintf(
            '{%% component %s with props only %%}{%% block content %%}%s{%% endblock %%}{%% endcomponent %%}',
            $twigName,
            $literalSlot,
        );

        return $this->twig->createTemplate($source)->render(['props' => $props]);
    }
}

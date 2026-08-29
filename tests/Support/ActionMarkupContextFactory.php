<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Support;

use DOMDocument;
use DOMElement;
use Symfinity\UiAction\ActionMarkupContext;

final class ActionMarkupContextFactory
{
    public static function fromInteractiveHtml(
        string $html,
        bool $parentIsForm = false,
        ?string $formMethod = null,
        bool $hasCsrfField = false,
    ): ActionMarkupContext {
        $document = new DOMDocument();
        $previous = libxml_use_internal_errors(true);
        $document->loadHTML('<?xml encoding="UTF-8">' . $html, \LIBXML_HTML_NOIMPLIED | \LIBXML_HTML_NODEFDTD);
        libxml_clear_errors();
        libxml_use_internal_errors($previous);

        $element = self::findInteractiveElement($document);
        if (!$element instanceof DOMElement) {
            throw new \RuntimeException('No interactive element found in rendered HTML.');
        }

        return new ActionMarkupContext(
            strtolower($element->tagName),
            self::attributesFromElement($element),
            $parentIsForm,
            $formMethod,
            $hasCsrfField,
        );
    }

    private static function findInteractiveElement(DOMDocument $document): ?DOMElement
    {
        foreach (['a', 'button'] as $tag) {
            $nodes = $document->getElementsByTagName($tag);
            if ($nodes->length > 0 && $nodes->item(0) instanceof DOMElement) {
                return $nodes->item(0);
            }
        }

        return null;
    }

    /**
     * @return array<string, string|bool>
     */
    private static function attributesFromElement(DOMElement $element): array
    {
        $attributes = [];
        foreach ($element->attributes as $attribute) {
            $name = strtolower($attribute->name);
            if (str_starts_with($name, 'data-ui-')) {
                continue;
            }

            $attributes[$name] = $attribute->value !== '' ? $attribute->value : true;
        }

        return $attributes;
    }
}

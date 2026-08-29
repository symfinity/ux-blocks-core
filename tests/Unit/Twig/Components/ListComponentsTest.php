<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class ListComponentsTest extends ComponentTestCase
{
    #[Test]
    public function itRendersListRootAttributes(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('List');

        self::assertRootAttributes($html, 'list', 'blocks.list');
        self::assertStringContainsString('data-ui-part="list-layout"', $html);
        self::assertStringContainsString('data-ui-gap="md"', $html);
    }

    #[Test]
    public function itemRendersListItemPartHook(): void
    {
        self::bootKernel();

        $html = (string) $this->renderTwigComponent('List:Item', [], content: 'Row body');

        self::assertStringContainsString('data-ui-part="list-item"', $html);
        self::assertStringContainsString('Row body', $html);
    }

    #[Test]
    public function itemTitleAndDescriptionRenderPartHooks(): void
    {
        self::bootKernel();

        $title = (string) $this->renderTwigComponent('List:Item:Title', [], content: 'Title copy');
        $description = (string) $this->renderTwigComponent('List:Item:Description', [], content: 'Description copy');

        self::assertStringContainsString('data-ui-part="list-item-title"', $title);
        self::assertStringContainsString('Title copy', $title);
        self::assertStringContainsString('data-ui-part="list-item-description"', $description);
        self::assertStringContainsString('Description copy', $description);
    }

    #[Test]
    public function itEmitsColumnsVariantAndGapProps(): void
    {
        self::bootKernel();

        $html = $this->renderComponent('List', ['variant' => 'columns', 'gap' => 'lg']);

        self::assertStringContainsString('data-ui-variant="columns"', $html);
        self::assertStringContainsString('data-ui-gap="lg"', $html);
    }
}

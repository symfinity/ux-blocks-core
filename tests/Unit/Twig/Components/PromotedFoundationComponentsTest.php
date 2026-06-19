<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use Symfinity\UxBlocksCore\Breadcrumb\BreadcrumbItem;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

/** 094 — eight atoms promoted from extended to core. */
final class PromotedFoundationComponentsTest extends ComponentTestCase
{
    /** @return array<string, array{0: string, 1: string, 2: string, 3?: array<string, mixed>}> */
    public static function promotedComponentProvider(): array
    {
        return [
            'grid' => ['Grid', 'grid', 'blocks.grid', ['columns' => 2]],
            'stack' => ['Stack', 'stack', 'blocks.stack'],
            'list' => ['List', 'list', 'blocks.list'],
            'breadcrumb' => ['Breadcrumb', 'breadcrumb', 'blocks.breadcrumb', ['auto' => false, 'items' => [new BreadcrumbItem('Home', '/')]]],
            'pagination' => ['Pagination', 'pagination', 'blocks.pagination'],
            'fieldset' => ['Fieldset', 'fieldset', 'blocks.fieldset'],
            'input-group' => ['InputGroup', 'input-group', 'blocks.input-group'],
            'button-group' => ['ButtonGroup', 'button-group', 'blocks.button-group'],
        ];
    }

    #[Test]
    #[DataProvider('promotedComponentProvider')]
    public function itRendersRegistryAttributes(string $component, string $role, string $fragment, array $data = []): void
    {
        self::bootKernel();
        $html = $this->renderComponent($component, $data);

        $this->assertRootAttributes($html, $role, $fragment);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class V1LayoutComponentsTest extends ComponentTestCase
{
    /** @return array<string, array{0: string, 1: string, 2: string, 3?: array<string, mixed>}> */
    public static function layoutComponentProvider(): array
    {
        return [
            'scroll-area' => ['ScrollArea', 'scroll-area', 'blocks.scroll-area'],
            'aspect-ratio' => ['AspectRatio', 'aspect-ratio', 'blocks.aspect-ratio', ['ratio' => '4/3']],
            'divider' => ['Divider', 'divider', 'blocks.divider'],
        ];
    }

    #[Test]
    #[DataProvider('layoutComponentProvider')]
    public function itRendersRegistryAttributes(string $component, string $role, string $fragment, array $data = []): void
    {
        self::bootKernel();
        $html = $this->renderComponent($component, $data);

        $this->assertRootAttributes($html, $role, $fragment);
    }
}

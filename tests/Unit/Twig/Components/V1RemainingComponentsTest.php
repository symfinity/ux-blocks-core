<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class V1RemainingComponentsTest extends ComponentTestCase
{
    /** @return array<string, array{0: string, 1: string, 2: string, 3?: array<string, mixed>}> */
    public static function remainingComponentProvider(): array
    {
        return [
            'link' => ['Link', 'link', 'blocks.link', ['href' => '/docs']],
            'switch' => ['Switch', 'switch', 'blocks.switch', ['checked' => true]],
            'file-input' => ['FileInput', 'file-input', 'blocks.file-input'],
            'skeleton' => ['Skeleton', 'skeleton', 'blocks.skeleton'],
            'progress' => ['Progress', 'progress', 'blocks.progress', ['value' => 40, 'max' => 100]],
            'spinner' => ['Spinner', 'spinner', 'blocks.spinner', ['size' => 'md', 'density' => 'inline']],
            'badge' => ['Badge', 'badge', 'blocks.badge'],
            'avatar' => ['Avatar', 'avatar', 'blocks.avatar'],
            'kbd' => ['Kbd', 'kbd', 'blocks.kbd'],
        ];
    }

    #[Test]
    #[DataProvider('remainingComponentProvider')]
    public function itRendersRegistryAttributes(string $component, string $role, string $fragment, array $data = []): void
    {
        self::bootKernel();
        $html = $this->renderComponent($component, $data);

        $this->assertRootAttributes($html, $role, $fragment);
    }
}

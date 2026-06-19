<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

/** 101 — layout roots must merge caller {@code style} with density custom properties. */
final class LayoutComponentStyleMergeTest extends ComponentTestCase
{
    /** @return array<string, array{0: string, 1: string}> */
    public static function layoutComponentProvider(): array
    {
        return [
            'grid' => ['Grid', 'grid'],
            'stack' => ['Stack', 'stack'],
        ];
    }

    #[Test]
    #[DataProvider('layoutComponentProvider')]
    public function itMergesCallerStyleWithDensityCustomProperty(string $component, string $role): void
    {
        self::bootKernel();

        $html = $this->renderTwig(sprintf(
            '{%% component "%1$s" with { style: "margin-block-end: 1rem;" } %%}<span>item</span>{%% endcomponent %%}',
            $component,
        ));

        self::assertSame(1, preg_match_all('/\sstyle="/', $html), $html);
        self::assertStringContainsString('data-ui-role="' . $role . '"', $html);
        self::assertStringContainsString('--ui-density: comfortable;', $html);
        self::assertStringContainsString('margin-block-end: 1rem;', $html);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class StimulusControllersTest extends TestCase
{
    /** @return array<string, array{0: string}> */
    public static function coreControllerProvider(): array
    {
        return [
            'scheme-switch' => ['scheme_switch'],
            'collapsible' => ['collapsible'],
            'tooltip' => ['tooltip'],
            'popover' => ['popover'],
            'accordion' => ['accordion'],
            'alert' => ['alert'],
        ];
    }

    #[Test]
    #[DataProvider('coreControllerProvider')]
    public function coreTierControllerAssetExists(string $slug): void
    {
        $path = \dirname(__DIR__, 2) . '/assets/controllers/ux_blocks_core/' . $slug . '_controller.js';

        self::assertFileExists($path, sprintf('Missing Stimulus controller asset "%s"', $slug));
        self::assertNotSame('', trim((string) file_get_contents($path)));
    }

    #[Test]
    public function packageJsonRegistersOnlyExistingControllerAssets(): void
    {
        $root = \dirname(__DIR__, 2);
        $package = json_decode((string) file_get_contents($root . '/assets/package.json'), true);
        self::assertIsArray($package);

        foreach (array_keys($package['symfony']['controllers'] ?? []) as $slug) {
            $fileSlug = str_replace('-', '_', $slug);
            self::assertFileExists(
                $root . '/assets/controllers/ux_blocks_core/' . $fileSlug . '_controller.js',
                sprintf('package.json registers missing controller "%s"', $slug),
            );
        }
    }
}

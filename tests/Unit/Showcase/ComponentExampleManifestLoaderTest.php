<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Showcase;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Showcase\ComponentExampleManifestLoader;

final class ComponentExampleManifestLoaderTest extends TestCase
{
    #[Test]
    public function loadsAllCoreExampleManifests(): void
    {
        $examplesDir = \dirname(__DIR__, 3) . '/config/component-examples';
        $loader = new ComponentExampleManifestLoader($examplesDir);

        $manifests = $loader->loadAll();

        self::assertGreaterThanOrEqual(30, \count($manifests));
        $button = null;
        foreach ($manifests as $manifest) {
            if ($manifest->role === 'button') {
                $button = $manifest;
                break;
            }
        }
        self::assertNotNull($button);
        self::assertSame('button', $button->role);
        self::assertSame('Button', $button->twigName);
        self::assertNotEmpty($button->sections);
    }

    #[Test]
    public function loadRoleReturnsNullForMissingFile(): void
    {
        $examplesDir = \dirname(__DIR__, 3) . '/config/component-examples';
        $loader = new ComponentExampleManifestLoader($examplesDir);

        self::assertNull($loader->loadRole('not-a-real-role'));
    }
}

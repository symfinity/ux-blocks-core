<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class SemanticVariantNormalizationCoverageTest extends TestCase
{
    #[Test]
    public function componentsThatExposeSemanticVariantMustNormalizeBeforeRender(): void
    {
        $packagesRoot = dirname(__DIR__, 4);
        $componentDirs = glob($packagesRoot . '/ux-blocks-*/src/Twig/Components') ?: [];

        $missing = [];
        foreach ($componentDirs as $componentsDir) {
            $files = glob($componentsDir . '/*.php') ?: [];
            foreach ($files as $file) {
                $source = (string) file_get_contents($file);
                if (!str_contains($source, 'ExposesSemanticVariant')) {
                    continue;
                }
                if (!str_contains($source, 'NormalizesSemanticColourVariant')) {
                    $missing[] = str_replace($packagesRoot . '/', '', $file);
                }
            }
        }

        sort($missing);
        self::assertSame([], $missing, 'Add NormalizesSemanticColourVariant to: ' . implode(', ', $missing));
    }
}

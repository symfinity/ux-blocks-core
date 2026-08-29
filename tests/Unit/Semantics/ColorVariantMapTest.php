<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Semantics;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Semantics\ColorVariantMap;

final class ColorVariantMapTest extends TestCase
{
    #[Test]
    public function semanticVariantsMapToCanonicalTokenKeys(): void
    {
        self::assertSame('--ui-color-primary', ColorVariantMap::semanticTokenKey('primary'));
        self::assertSame('--ui-color-danger', ColorVariantMap::semanticTokenKey('danger'));
        self::assertSame('--ui-color-danger', ColorVariantMap::semanticTokenKey('error'));
    }

    #[Test]
    public function unknownVariantThrowsInvalidArgumentException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown semantic colour variant "neon".');

        ColorVariantMap::semanticTokenKey('neon');
    }
}

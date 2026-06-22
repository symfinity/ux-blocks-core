<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Twig\ModifierNormalizer;

final class ModifierNormalizerTest extends TestCase
{
    #[Test]
    public function canonicalSizeMapsLegacyDefaultToMd(): void
    {
        self::assertSame('md', ModifierNormalizer::canonicalSize('default'));
        self::assertSame('lg', ModifierNormalizer::canonicalSize('lg'));
    }

    #[Test]
    public function strictSizeCoercesOffLexiconToDefault(): void
    {
        self::assertSame('md', ModifierNormalizer::size('default'));
        self::assertSame('sm', ModifierNormalizer::size('sm'));
        self::assertSame('md', ModifierNormalizer::size('enormous'));
    }

    #[Test]
    public function densityFallsBackToComfortable(): void
    {
        self::assertSame('compact', ModifierNormalizer::density('compact'));
        self::assertSame('comfortable', ModifierNormalizer::density('comfortable'));
        self::assertSame('comfortable', ModifierNormalizer::density('spacious'));
    }

    #[Test]
    public function appearanceFallsBackToDefault(): void
    {
        self::assertSame('ghost', ModifierNormalizer::appearance('ghost'));
        self::assertSame('solid', ModifierNormalizer::appearance('bogus'));
        self::assertSame('outline', ModifierNormalizer::appearance('bogus', 'outline'));
    }

    #[Test]
    public function stateFlagNormalizesTruthyValues(): void
    {
        self::assertTrue(ModifierNormalizer::stateFlag(true));
        self::assertTrue(ModifierNormalizer::stateFlag('true'));
        self::assertTrue(ModifierNormalizer::stateFlag('1'));
        self::assertFalse(ModifierNormalizer::stateFlag(false));
        self::assertFalse(ModifierNormalizer::stateFlag('false'));
        self::assertFalse(ModifierNormalizer::stateFlag(''));
    }
}

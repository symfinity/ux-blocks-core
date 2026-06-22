<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Contract;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Contract\ForbiddenSemanticVariantEmission;

final class ForbiddenSemanticVariantEmissionTest extends TestCase
{
    #[Test]
    public function domForbiddenIncludesDestructiveAndDefault(): void
    {
        self::assertContains('destructive', ForbiddenSemanticVariantEmission::DOM_FORBIDDEN);
        self::assertContains('default', ForbiddenSemanticVariantEmission::DOM_FORBIDDEN);
        self::assertContains('error', ForbiddenSemanticVariantEmission::DOM_FORBIDDEN);
    }

    #[Test]
    public function assertDomSafeRejectsDestructive(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('destructive');

        ForbiddenSemanticVariantEmission::assertDomSafe('destructive', 'test');
    }

    #[Test]
    public function kioskDemoIdRejectsDestructivePrefix(): void
    {
        self::assertTrue(ForbiddenSemanticVariantEmission::isForbiddenKioskDemoId('destructive-title'));
        self::assertFalse(ForbiddenSemanticVariantEmission::isForbiddenKioskDemoId('danger-title'));
    }
}

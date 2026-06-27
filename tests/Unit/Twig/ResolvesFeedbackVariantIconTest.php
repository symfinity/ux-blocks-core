<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Twig\ResolvesFeedbackVariantIcon;

final class ResolvesFeedbackVariantIconTest extends TestCase
{
    #[Test]
    public function itResolvesDefaultIconsByVariant(): void
    {
        $subject = $this->newSubject();

        $subject->variant = 'success';
        self::assertSame('lucide:circle-check', $subject->resolveFeedbackVariantIcon());

        $subject->variant = 'danger';
        self::assertSame('lucide:circle-x', $subject->resolveFeedbackVariantIcon());

        $subject->variant = 'warning';
        self::assertSame('lucide:triangle-alert', $subject->resolveFeedbackVariantIcon());

        $subject->variant = 'info';
        self::assertSame('lucide:info', $subject->resolveFeedbackVariantIcon());
    }

    #[Test]
    public function explicitIconOverridesVariantDefault(): void
    {
        $subject = $this->newSubject();
        $subject->variant = 'success';
        $subject->icon = 'lucide:star';

        self::assertSame('lucide:star', $subject->resolveFeedbackVariantIcon());
    }

    #[Test]
    public function emptyIconStringSuppressesIcon(): void
    {
        $subject = $this->newSubject();
        $subject->variant = 'success';
        $subject->icon = '';

        self::assertNull($subject->resolveFeedbackVariantIcon());
    }

    private function newSubject(): object
    {
        return new class {
            use ResolvesFeedbackVariantIcon;
        };
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Twig\Components\AspectRatio;

final class AspectRatioTest extends TestCase
{
    #[Test]
    public function ratioCssParsesColonAndSlashRatios(): void
    {
        $component = new AspectRatio();
        $component->ratio = '3/4';
        self::assertSame('3 / 4', $component->ratioCss());

        $component->ratio = '16:9';
        self::assertSame('16 / 9', $component->ratioCss());

        $component->ratio = '21/9';
        self::assertSame('21 / 9', $component->ratioCss());

        $component->ratio = '9/16';
        self::assertSame('9 / 16', $component->ratioCss());
    }

    #[Test]
    public function ratioCssFallsBackToSixteenByNine(): void
    {
        $component = new AspectRatio();
        $component->ratio = 'invalid';

        self::assertSame('16 / 9', $component->ratioCss());
    }
}

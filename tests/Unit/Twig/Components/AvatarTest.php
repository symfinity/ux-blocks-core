<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class AvatarTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Avatar', ['variant' => 'primary', 'size' => 'lg']);

        $this->assertRootAttributes($html, 'avatar', 'blocks.avatar');
        self::assertStringContainsString('data-ui-variant="primary"', $html);
        self::assertStringContainsString('data-ui-size="lg"', $html);
    }

    #[Test]
    public function defaultAvatarUsesPrimaryVariant(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Avatar', ['size' => 'default']);

        $this->assertRootAttributes($html, 'avatar', 'blocks.avatar');
        self::assertStringContainsString('data-ui-variant="primary"', $html);
    }
}

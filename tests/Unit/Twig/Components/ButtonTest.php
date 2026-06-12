<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Twig\Components\Button;

final class ButtonTest extends ComponentTestCase
{
    #[Test]
    public function itRendersRegistryAttributes(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', ['variant' => 'secondary']);

        $this->assertRootAttributes($html, 'button', 'blocks.button');
        self::assertStringContainsString('data-ui-variant="secondary"', $html);
    }

    #[Test]
    public function itRendersBlockLayoutAttribute(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', ['block' => true]);

        self::assertStringContainsString('data-ui-layout="block"', $html);
    }

    #[Test]
    public function itRendersAnchorWithHrefWhenAsLink(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'as' => 'a',
            'href' => '/catalog',
        ]);

        self::assertMatchesRegularExpression('/<a[\s>]/', $html);
        self::assertStringContainsString('href="/catalog"', $html);
        self::assertDoesNotMatchRegularExpression('/<button[\s>]/', $html);
    }

    #[Test]
    public function itOmitsHrefOnNativeButton(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'as' => 'button',
            'href' => '/ignored',
        ]);

        self::assertMatchesRegularExpression('/<button[\s>]/', $html);
        self::assertStringNotContainsString('href=', $html);
    }
}

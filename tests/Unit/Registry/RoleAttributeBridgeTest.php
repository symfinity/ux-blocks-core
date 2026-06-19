<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Tests\Unit\Twig\Components\ComponentTestCase;

final class RoleAttributeBridgeTest extends ComponentTestCase
{
    #[Test]
    public function buttonGetsDataUiRoleFromBridge(): void
    {
        $this->bootWithFragmentIds(true);
        $html = $this->renderComponent('Button', [], 'Save');

        self::assertStringContainsString('data-ui-role="button"', $html);
    }

    #[Test]
    public function fragmentOffOmitsDataUiFragmentOnRoot(): void
    {
        $this->bootWithFragmentIds(false);
        $html = $this->renderComponent('Button');

        self::assertStringContainsString('data-ui-role="button"', $html);
        self::assertStringNotContainsString('data-ui-fragment="blocks.button"', $html);
    }

    #[Test]
    public function fragmentOnEmitsCatalogFragmentId(): void
    {
        $this->bootWithFragmentIds(true);
        $html = $this->renderComponent('Button');

        self::assertStringContainsString('data-ui-role="button"', $html);
        self::assertStringContainsString('data-ui-fragment="blocks.button"', $html);
    }

    #[Test]
    public function explicitAttributeOverrideWins(): void
    {
        $this->bootWithFragmentIds(true);
        $html = $this->renderComponent('Button', [
            'attributes' => [
                'data-ui-role' => 'custom-role',
                'data-ui-fragment' => 'custom.fragment',
            ],
        ]);

        self::assertStringContainsString('data-ui-role="custom-role"', $html);
        self::assertStringContainsString('data-ui-fragment="custom.fragment"', $html);
        self::assertStringNotContainsString('data-ui-role="button"', $html);
    }

    #[Test]
    public function flashStackCompoundGetsBridgeRole(): void
    {
        $this->bootWithFragmentIds(true);
        $html = $this->renderComponent('FlashStack');

        self::assertStringContainsString('data-ui-role="flash-stack"', $html);
        self::assertStringContainsString('data-ui-fragment="blocks.flash-stack"', $html);
    }

    private function bootWithFragmentIds(bool $enabled): void
    {
        if (static::$booted) {
            static::ensureKernelShutdown();
        }

        $_ENV['UX_BLOCKS_TEST_FRAGMENT_IDS'] = $enabled ? '1' : '0';
        $_SERVER['UX_BLOCKS_TEST_FRAGMENT_IDS'] = $_ENV['UX_BLOCKS_TEST_FRAGMENT_IDS'];
        self::bootKernel();
    }
}

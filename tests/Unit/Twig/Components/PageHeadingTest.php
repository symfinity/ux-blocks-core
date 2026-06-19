<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class PageHeadingTest extends ComponentTestCase
{
    #[Test]
    public function defaultRendersH1(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('PageHeading', [], content: 'Settings');

        $this->assertRootAttributes($html, 'page-heading', 'blocks.page-heading');
        self::assertStringContainsString('<h1 data-ui-part="title">', $html);
        self::assertStringContainsString('Settings', $html);
        self::assertStringContainsString('data-ui-part="row"', $html);
        self::assertStringContainsString('data-ui-part="title-stack"', $html);
    }

    #[Test]
    public function levelOverrideRendersRequestedHeading(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('PageHeading', ['level' => 2], content: 'Nested title');

        self::assertStringContainsString('<h2 data-ui-part="title">', $html);
    }

    #[Test]
    public function stringLevelNormalizesToHeadingTag(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('PageHeading', ['level' => 'h3'], content: 'Card title');

        self::assertStringContainsString('<h3 data-ui-part="title">', $html);
    }

    #[Test]
    public function numericStringLevelNormalizesToHeadingTag(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('PageHeading', ['level' => '1'], content: 'Dashboard');

        self::assertStringContainsString('<h1 data-ui-part="title">', $html);
        self::assertStringContainsString('Dashboard', $html);
    }

    #[Test]
    public function iconRendersLockedStartSlot(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('PageHeading', [
            'icon' => 'lucide:settings',
            'iconPosition' => 'end',
        ], content: 'Settings');

        self::assertStringContainsString('data-ui-part="icon"', $html);
        self::assertSame(1, substr_count($html, 'data-ui-part="icon"'));
        self::assertMatchesRegularExpression('/data-ui-part="icon"[\s\S]*data-ui-part="title-stack"/', $html);
    }

    #[Test]
    public function breadcrumbRendersBeforeTitleRow(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(<<<'TWIG'
<twig:PageHeading>
    <twig:block name="title">Settings</twig:block>
    <twig:block name="breadcrumb"><a href="/">Home</a></twig:block>
</twig:PageHeading>
TWIG);

        self::assertMatchesRegularExpression(
            '/data-ui-part="breadcrumb"[\s\S]*data-ui-part="row"/',
            $html,
        );
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

final class V1RemainingComponentsTest extends ComponentTestCase
{
    /** @return array<string, array{0: string, 1: string, 2: string, 3?: array<string, mixed>}> */
    public static function remainingComponentProvider(): array
    {
        return [
            'navbar' => ['Navbar', 'navbar', 'blocks.navbar'],
            'breadcrumb' => ['Breadcrumb', 'breadcrumb', 'blocks.breadcrumb'],
            'pagination' => ['Pagination', 'pagination', 'blocks.pagination'],
            'steps' => ['Steps', 'steps', 'blocks.steps'],
            'link' => ['Link', 'link', 'blocks.link', ['href' => '/docs']],
            'dialog' => ['Dialog', 'dialog', 'blocks.dialog'],
            'popover' => ['Popover', 'popover', 'blocks.popover'],
            'tooltip' => ['Tooltip', 'tooltip', 'blocks.tooltip', ['label' => 'Hint']],
            'switch' => ['Switch', 'switch', 'blocks.switch', ['checked' => true]],
            'input-group' => ['InputGroup', 'input-group', 'blocks.input-group'],
            'file-input' => ['FileInput', 'file-input', 'blocks.file-input'],
            'fieldset' => ['Fieldset', 'fieldset', 'blocks.fieldset'],
            'skeleton' => ['Skeleton', 'skeleton', 'blocks.skeleton'],
            'progress' => ['Progress', 'progress', 'blocks.progress', ['value' => 40, 'max' => 100]],
            'spinner' => ['Spinner', 'spinner', 'blocks.spinner'],
            'badge' => ['Badge', 'badge', 'blocks.badge'],
            'avatar' => ['Avatar', 'avatar', 'blocks.avatar'],
            'kbd' => ['Kbd', 'kbd', 'blocks.kbd'],
            'description-list' => ['DescriptionList', 'description-list', 'blocks.description-list'],
            'list' => ['List', 'list', 'blocks.list'],
            'stat' => ['Stat', 'stat', 'blocks.stat'],
            'timeline' => ['Timeline', 'timeline', 'blocks.timeline'],
            'carousel' => ['Carousel', 'carousel', 'blocks.carousel'],
            'button-group' => ['ButtonGroup', 'button-group', 'blocks.button-group'],
            'accordion' => ['Accordion', 'accordion', 'blocks.accordion'],
            'page-heading' => ['PageHeading', 'page-heading', 'blocks.page-heading'],
            'section-heading' => ['SectionHeading', 'section-heading', 'blocks.section-heading'],
            'auth-layout' => ['AuthLayout', 'auth-layout', 'blocks.auth-layout'],
            'dashboard-shell' => ['DashboardShell', 'dashboard-shell', 'blocks.dashboard-shell'],
        ];
    }

    #[Test]
    #[DataProvider('remainingComponentProvider')]
    public function itRendersRegistryAttributes(string $component, string $role, string $fragment, array $data = []): void
    {
        self::bootKernel();
        $html = $this->renderComponent($component, $data);

        $this->assertRootAttributes($html, $role, $fragment);
    }

    #[Test]
    public function dialogUsesNativeDialogElement(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Dialog');

        self::assertStringContainsString('<dialog', $html);
    }

    #[Test]
    public function popoverUsesNativePopoverAttribute(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Popover');

        self::assertMatchesRegularExpression('/\spopover(\s|>|=)/', $html);
    }

    #[Test]
    public function switchUsesCheckboxSemantics(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Switch', ['checked' => true]);

        self::assertStringContainsString('type="checkbox"', $html);
        self::assertStringContainsString('role="switch"', $html);
    }

    #[Test]
    public function progressUsesNativeProgressElement(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Progress', ['value' => 25, 'max' => 100]);

        self::assertStringContainsString('<progress', $html);
        self::assertStringContainsString('value="25"', $html);
    }
}

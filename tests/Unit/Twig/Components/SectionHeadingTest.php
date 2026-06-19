<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class SectionHeadingTest extends ComponentTestCase
{
    #[Test]
    public function defaultRendersH2(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('SectionHeading', [], content: 'Profile');

        $this->assertRootAttributes($html, 'section-heading', 'blocks.section-heading');
        self::assertStringContainsString('<h2 data-ui-part="title">', $html);
        self::assertStringContainsString('Profile', $html);
    }

    #[Test]
    public function levelOverrideRendersRequestedHeading(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('SectionHeading', ['level' => 3], content: 'Card section');

        self::assertStringContainsString('<h3 data-ui-part="title">', $html);
    }
}

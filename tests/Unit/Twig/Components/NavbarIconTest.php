<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class NavbarIconTest extends ComponentTestCase
{
    #[Test]
    public function brandRendersLockedStartIconBeforeContent(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Navbar', [
            'icon' => 'lucide:layers',
        ], 'Acme');

        self::assertStringContainsString('data-ui-part="navbar-brand"', $html);
        self::assertMatchesRegularExpression('/data-ui-part="icon"[\s\S]*Acme/', $html);
    }
}

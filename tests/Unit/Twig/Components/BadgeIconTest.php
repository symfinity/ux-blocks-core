<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class BadgeIconTest extends ComponentTestCase
{
    #[Test]
    public function startPositionRendersIconBeforeContent(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Badge with { icon: "lucide:sparkles", iconPosition: "end" } %}{% block content %}New{% endblock %}{% endcomponent %}',
        );

        self::assertStringContainsString('data-ui-part="icon"', $html);
        self::assertMatchesRegularExpression('/data-ui-part="icon"[\s\S]*New/', $html);
    }

    #[Test]
    public function headlessKernelRendersWithoutUxIcons(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Badge', [
            'icon' => 'lucide:sparkles',
        ]);

        self::assertStringContainsString('data-ui-part="icon"', $html);
    }
}

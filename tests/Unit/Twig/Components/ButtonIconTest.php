<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class ButtonIconTest extends ComponentTestCase
{
    #[Test]
    public function startPositionRendersIconBeforeContent(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Button with { icon: "lucide:plus", iconPosition: "start" } %}{% block content %}Save{% endblock %}{% endcomponent %}',
        );

        self::assertStringContainsString('data-ui-part="icon"', $html);
        self::assertMatchesRegularExpression('/data-ui-part="icon"[\s\S]*Save/', $html);
    }

    #[Test]
    public function endPositionRendersIconAfterContent(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Button with { icon: "lucide:arrow-right", iconPosition: "end" } %}{% block content %}Next{% endblock %}{% endcomponent %}',
        );

        self::assertMatchesRegularExpression('/Next[\s\S]*data-ui-part="icon"/', $html);
    }

    #[Test]
    public function onlyPositionRendersIconWithoutContent(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Button with { icon: "lucide:settings", iconPosition: "only", attributes: { "aria-label": "Settings" } } %}{% block content %}Hidden{% endblock %}{% endcomponent %}',
        );

        self::assertStringContainsString('data-ui-layout="icon-only"', $html);
        self::assertStringContainsString('aria-label="Settings"', $html);
        self::assertStringNotContainsString('Hidden', $html);
    }

    #[Test]
    public function headlessKernelRendersEmptyIconPartWithoutUxIcons(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'icon' => 'lucide:plus',
            'iconPosition' => 'start',
        ]);

        self::assertStringContainsString('data-ui-part="icon"', $html);
    }
}

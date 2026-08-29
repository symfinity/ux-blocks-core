<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;

final class LinkIconTest extends ComponentTestCase
{
    #[Test]
    public function externalLinkRendersDefaultEndIcon(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Link with { href: "https://example.com", external: true } %}{% block content %}Docs{% endblock %}{% endcomponent %}',
        );

        self::assertStringContainsString('data-ui-part="icon"', $html);
        self::assertMatchesRegularExpression('/Docs[\s\S]*data-ui-part="icon"/', $html);
        self::assertStringContainsString('data-ui-external="true"', $html);
    }

    #[Test]
    public function internalLinkRendersStartIconWhenExplicit(): void
    {
        self::bootKernel();
        $html = $this->renderTwig(
            '{% component Link with { icon: "lucide:home", iconPosition: "end" } %}{% block content %}Home{% endblock %}{% endcomponent %}',
        );

        self::assertMatchesRegularExpression('/data-ui-part="icon"[\s\S]*Home/', $html);
    }

    #[Test]
    public function headlessKernelRendersEmptyIconPartWithoutUxIcons(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Link', [
            'external' => true,
        ]);

        self::assertStringContainsString('data-ui-part="icon"', $html);
    }
}

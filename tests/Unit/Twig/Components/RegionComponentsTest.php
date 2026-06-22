<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Tests\Integration\UxBlocksCoreTestKernel;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;

final class RegionComponentsTest extends KernelTestCase
{
    use InteractsWithTwigComponents;

    protected static function getKernelClass(): string
    {
        return UxBlocksCoreTestKernel::class;
    }

    #[Test]
    public function headerEmitsUniversalPart(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Header', [], 'Title');

        self::assertStringContainsString('<header', $html);
        self::assertStringContainsString('data-ui-part="header"', $html);
        self::assertStringContainsString('Title', $html);
    }

    #[Test]
    public function footerEmitsUniversalPart(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Footer', [], 'Meta');

        self::assertStringContainsString('<footer', $html);
        self::assertStringContainsString('data-ui-part="footer"', $html);
    }

    #[Test]
    public function mediaEmitsUniversalPartWithOptionalIcon(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Media', ['icon' => 'lucide:inbox']);

        self::assertStringContainsString('<figure', $html);
        self::assertStringContainsString('data-ui-part="media"', $html);
        self::assertStringContainsString('data-ui-part="icon"', $html);
    }

    #[Test]
    public function mediaIconVariantEmitsDataUiVariant(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Media', [
            'variant' => 'icon',
            'icon' => 'lucide:inbox',
        ]);

        self::assertStringContainsString('data-ui-variant="icon"', $html);
        self::assertStringContainsString('data-ui-part="icon"', $html);
    }

    #[Test]
    public function mediaDefaultVariantOmitsDataUiVariant(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Media', ['icon' => 'lucide:inbox']);

        self::assertStringNotContainsString('data-ui-variant=', $html);
    }

    #[Test]
    public function actionsEmitsGroupRole(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Actions', [], 'Save');

        self::assertStringContainsString('role="group"', $html);
        self::assertStringContainsString('data-ui-part="actions"', $html);
    }

    #[Test]
    public function asideEmitsUniversalPart(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Aside', [], 'Sidebar');

        self::assertStringContainsString('<aside', $html);
        self::assertStringContainsString('data-ui-part="aside"', $html);
    }
}

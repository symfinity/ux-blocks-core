<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

final class NavbarStructureTest extends TestCase
{
    #[Test]
    public function navbarLivesInCoreWithBlocksFragment(): void
    {
        $coreClass = 'Symfinity\\UxBlocksCore\\Twig\\Components\\Navbar';
        $extendedClass = 'Symfinity\\UxBlocksExtended\\Twig\\Components\\Navbar';

        self::assertTrue(
            class_exists($coreClass),
            sprintf(
                'Expected %s; the class is still %s',
                $coreClass,
                class_exists($extendedClass) ? $extendedClass : 'missing',
            ),
        );

        $attribute = (new \ReflectionClass($coreClass))->getAttributes(AsTwigComponent::class)[0] ?? null;
        self::assertNotNull($attribute);
        $arguments = $attribute->getArguments();
        $template = $arguments['template'] ?? $arguments[1] ?? null;
        self::assertSame('@UxBlocksCore/components/Navbar.html.twig', $template);

        $packageDir = dirname(__DIR__, 4);
        $twig = (string) file_get_contents($packageDir.'/templates/components/Navbar.html.twig');
        self::assertStringContainsString('data-ui-fragment="blocks.navbar"', $twig);
        self::assertStringContainsString('data-ui-part="navbar-sticky"', $twig);
        self::assertStringContainsString('data-ui-part="navbar-chrome"', $twig);
        self::assertStringNotContainsString('data-controller', $twig);

        $yaml = (string) file_get_contents($packageDir.'/config/ux_roles.yaml');
        self::assertMatchesRegularExpression('/^\\s*- role: navbar\\s*$/m', $yaml);
        self::assertStringContainsString('fragment_id: blocks.navbar', $yaml);
        self::assertStringContainsString('Symfinity\\UxBlocksCore\\Twig\\Components\\Navbar', $yaml);
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Twig\OptionalUxIconExtension;
use Twig\Environment;
use Twig\Loader\ArrayLoader;
use Twig\TwigFunction;

final class OptionalUxIconExtensionTest extends TestCase
{
    #[Test]
    public function rendersViaUxIconTwigFunction(): void
    {
        $env = new Environment(new ArrayLoader());
        $env->addFunction(new TwigFunction(
            'ux_icon',
            static fn (string $name): string => '<svg data-icon="' . htmlspecialchars($name, \ENT_QUOTES) . '"></svg>',
            ['is_safe' => ['html']],
        ));
        $env->addExtension(new OptionalUxIconExtension());

        $html = (new OptionalUxIconExtension())->renderIcon($env, 'lucide:save');

        self::assertStringContainsString('data-icon="lucide:save"', $html);
    }

    #[Test]
    public function returnsEmptyWhenUxIconsAbsent(): void
    {
        $env = new Environment(new ArrayLoader());
        $env->addExtension(new OptionalUxIconExtension());

        self::assertSame('', (new OptionalUxIconExtension())->renderIcon($env, 'lucide:save'));
    }

    #[Test]
    public function returnsEmptyForBlankName(): void
    {
        $env = new Environment(new ArrayLoader());

        self::assertSame('', (new OptionalUxIconExtension())->renderIcon($env, null));
        self::assertSame('', (new OptionalUxIconExtension())->renderIcon($env, '   '));
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\UX\TwigComponent\Test\InteractsWithTwigComponents;
use Symfinity\UxBlocksCore\Tests\Integration\UxBlocksCoreTestKernel;

abstract class ComponentTestCase extends KernelTestCase
{
    use InteractsWithTwigComponents;

    protected static function getKernelClass(): string
    {
        return UxBlocksCoreTestKernel::class;
    }

    public static function bootKernel(array $options = []): \Symfony\Component\HttpKernel\KernelInterface
    {
        if (!isset($_SERVER['UX_BLOCKS_TEST_FRAGMENT_IDS'])) {
            $_ENV['UX_BLOCKS_TEST_FRAGMENT_IDS'] = '1';
            $_SERVER['UX_BLOCKS_TEST_FRAGMENT_IDS'] = '1';
        }

        return parent::bootKernel($options);
    }

    /**
     * @param class-string|non-empty-string $name
     * @param array<string, mixed>          $data
     */
    protected function renderComponent(string $name, array $data = [], ?string $content = null): string
    {
        if (null === $content) {
            return (string) $this->renderTwigComponent($name, $data);
        }

        return (string) $this->renderTwigComponent($name, $data, $content);
    }

    protected function renderTwig(string $template): string
    {
        if (static::$booted === false) {
            self::bootKernel();
        }

        return (string) self::getContainer()->get('twig')->createTemplate($template)->render([]);
    }

    protected function assertRootAttributes(string $html, string $role, ?string $fragment = null): void
    {
        self::assertStringContainsString(sprintf('data-ui-role="%s"', $role), $html);
        if (null !== $fragment) {
            self::assertStringContainsString(sprintf('data-ui-fragment="%s"', $fragment), $html);
        }
        self::assertDoesNotMatchRegularExpression('/html_cva|tailwind_merge|twig-tailwind-extra/', $html);
    }
}

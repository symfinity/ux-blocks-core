<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use Symfinity\UiKernel\UiKernelBundle;
use Symfinity\UxBlocksCore\SymfinityUxBlocksCoreBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Bundle\TwigBundle\TwigBundle;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\UX\StimulusBundle\StimulusBundle;
use Symfony\UX\TwigComponent\TwigComponentBundle;

final class UxBlocksCoreTestKernel extends Kernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return \dirname(__DIR__, 2);
    }

    public function getCacheDir(): string
    {
        return $this->getProjectDir() . '/var/cache/' . $this->environment;
    }

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
            new TwigBundle(),
            new StimulusBundle(),
            new TwigComponentBundle(),
            new UiKernelBundle(),
            new SymfinityUxBlocksCoreBundle(),
        ];
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->extension('symfinity_ui_kernel', [
            'schema_version' => '1.0',
            'default_theme' => 'default',
            'default_variant' => 'default',
        ]);

        $container->extension('framework', [
            'secret' => 'test-secret',
            'test' => true,
            'router' => ['utf8' => true],
            'php_errors' => ['log' => false],
            'form' => ['enabled' => true],
            'validation' => ['enabled' => true],
        ]);

        $container->extension('twig', [
            'form_themes' => [],
        ]);

        $container->services()
            ->set('twig.extension.form', StubFormTwigExtension::class)
            ->tag('twig.extension')
            ->public();
    }
}

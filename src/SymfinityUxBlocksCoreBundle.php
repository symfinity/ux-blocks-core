<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore;

use Symfony\Bundle\TwigBundle\DependencyInjection\Configurator\TwigConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class SymfinityUxBlocksCoreBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

    public function getContainerExtension(): ExtensionInterface
    {
        return new DependencyInjection\SymfinityUxBlocksCoreExtension();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);
        $container->setParameter('ux_blocks_core.package_dir', $this->getPath());
    }

    public function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getPath() . '/config/routes.yaml');
    }

    public function configureTwig(TwigConfigurator $configurator): void
    {
        $configurator->path($this->getPath() . '/templates', 'UxBlocksCore');
    }
}

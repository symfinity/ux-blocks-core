<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

final class SymfinityUxBlocksCoreExtension extends Extension implements PrependExtensionInterface
{
    public function prepend(ContainerBuilder $container): void
    {
        if ($container->hasExtension('framework')) {
            $container->prependExtensionConfig('framework', [
                'asset_mapper' => [
                    'paths' => [
                        \dirname(__DIR__, 2) . '/assets' => 'ux-blocks-core',
                    ],
                ],
            ]);
        }

        $container->prependExtensionConfig('twig', [
            'paths' => [
                \dirname(__DIR__, 2) . '/templates' => 'UxBlocksCore',
            ],
        ]);

        $container->prependExtensionConfig('twig_component', [
            'defaults' => [
                'Symfinity\\UxBlocksCore\\Twig\\Components\\' => [
                    'template_directory' => 'components',
                ],
            ],
        ]);
    }

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $packageDir = \dirname(__DIR__, 2);
        $container->setParameter('ux_blocks_core.package_dir', $packageDir);
        $container->setParameter('ux_blocks_core.fragment_ids', (bool) $config['fragment_ids']);

        $loader = new YamlFileLoader($container, new FileLocator($packageDir . '/config'));
        $loader->load('services.yaml');
    }

    public function getAlias(): string
    {
        return 'symfinity_ux_blocks_core';
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\DependencyInjection;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\DependencyInjection\Configuration;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\Config\Definition\Processor;

final class ConfigurationUiAssetsTest extends TestCase
{
    #[Test]
    public function alwaysTiersDefaultsToEmpty(): void
    {
        self::assertSame([], $this->process([])['ui_assets']['always_tiers']);
    }

    #[Test]
    public function alwaysTiersAcceptsKnownTiers(): void
    {
        self::assertSame(
            ['marketing'],
            $this->process(['ui_assets' => ['always_tiers' => ['marketing']]])['ui_assets']['always_tiers'],
        );
    }

    #[Test]
    public function alwaysTiersRejectsUnknownTiers(): void
    {
        $this->expectException(InvalidConfigurationException::class);

        $this->process(['ui_assets' => ['always_tiers' => ['live']]]);
    }

    /**
     * @param array<string, mixed> $config
     *
     * @return array<string, mixed>
     */
    private function process(array $config): array
    {
        /** @var array<string, mixed> */
        return (new Processor())->processConfiguration(new Configuration(), [$config]);
    }
}

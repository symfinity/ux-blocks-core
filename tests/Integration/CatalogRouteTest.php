<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocks\Registry\CoreRoleCatalog;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class CatalogRouteTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return UxBlocksCoreTestKernel::class;
    }

    #[Test]
    public function catalogReturns200(): void
    {
        $client = static::createClient();
        $client->request('GET', '/ux-blocks-core/catalog');

        self::assertResponseIsSuccessful();
    }

    #[Test]
    public function catalogContainsAllV0Roles(): void
    {
        $client = static::createClient();
        $client->request('GET', '/ux-blocks-core/catalog');
        $content = $client->getResponse()->getContent();

        self::assertIsString($content);

        foreach (CoreRoleCatalog::roles() as $role) {
            self::assertStringContainsString(sprintf('data-catalog-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-fragment="blocks.%s"', $role), $content);
        }
    }

    #[Test]
    public function catalogContainsAllV1Roles(): void
    {
        $client = static::createClient();
        $client->request('GET', '/ux-blocks-core/catalog');
        $content = $client->getResponse()->getContent();

        self::assertIsString($content);

        foreach ($this->v1Roles() as $role) {
            self::assertStringContainsString(sprintf('data-catalog-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-fragment="blocks.%s"', $role), $content);
        }
    }

    /** @return list<string> */
    private function v1Roles(): array
    {
        $path = \dirname(__DIR__, 2) . '/config/ux_roles.yaml';
        $registry = \Symfony\Component\Yaml\Yaml::parseFile($path);
        $roles = [];

        foreach ($registry['roles'] as $row) {
            if (($row['status'] ?? '') === 'v1') {
                $roles[] = $row['role'];
            }
        }

        return $roles;
    }
}

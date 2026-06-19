<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
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
    public function catalogContainsManifestRoles(): void
    {
        $client = static::createClient();
        $client->request('GET', '/ux-blocks-core/catalog');
        $content = $client->getResponse()->getContent();

        self::assertIsString($content);
        self::assertStringContainsString('variant matrix', $content);

        foreach (['button', 'badge', 'input', 'flash', 'breadcrumb'] as $role) {
            self::assertStringContainsString(sprintf('data-catalog-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-role="%s"', $role), $content);
            self::assertStringContainsString(sprintf('data-ui-fragment="blocks.%s"', $role), $content);
        }
    }
}

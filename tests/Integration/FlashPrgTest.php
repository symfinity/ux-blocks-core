<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class FlashPrgTest extends WebTestCase
{
    protected static function getKernelClass(): string
    {
        return UxBlocksCoreTestKernel::class;
    }

    #[Test]
    public function flashIsVisibleAfterRedirect(): void
    {
        $client = static::createClient();
        $client->request('POST', '/test/flash');
        $client->followRedirect();

        self::assertResponseIsSuccessful();
        self::assertStringContainsString('data-ui-role="flash"', (string) $client->getResponse()->getContent());
        self::assertStringContainsString('Saved', (string) $client->getResponse()->getContent());
    }
}

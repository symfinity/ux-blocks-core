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

        $content = (string) $client->getResponse()->getContent();
        self::assertResponseIsSuccessful();
        self::assertStringContainsString('data-ui-role="flash"', $content);
        self::assertStringContainsString('Saved', $content);
        self::assertStringContainsString('id="ux-blocks-core-css"', $content);
    }
}

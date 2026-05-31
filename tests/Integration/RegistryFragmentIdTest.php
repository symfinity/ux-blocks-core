<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocks\Registry\CoreRoleCatalog;
use Symfony\Component\Yaml\Yaml;

final class RegistryFragmentIdTest extends TestCase
{
    #[Test]
    public function fragmentIdsMatchRoleRegistryContract(): void
    {
        $path = \dirname(__DIR__, 2) . '/config/ux_roles.yaml';
        $registry = Yaml::parseFile($path);

        self::assertSame('blocks', $registry['prefix']);

        foreach ($registry['roles'] as $row) {
            if (($row['status'] ?? '') !== 'v0') {
                continue;
            }

            self::assertContains($row['role'], CoreRoleCatalog::roles());
            self::assertSame('blocks.' . $row['role'], $row['fragment_id']);
        }
    }
}

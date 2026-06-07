<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocks\Registry\CoreRoleCatalog;
use Symfony\Component\Yaml\Yaml;

final class UxRolesYamlConsistencyTest extends TestCase
{
    #[Test]
    public function yamlSchemaMatchesContract(): void
    {
        $registry = Yaml::parseFile(\dirname(__DIR__, 3) . '/config/ux_roles.yaml');

        self::assertSame('1.3', $registry['ux_role_registry']);
        self::assertSame('blocks', $registry['registry_prefix']);
        self::assertCount(22, $registry['roles']);
        self::assertSame(CoreRoleCatalog::roles(), array_column($registry['roles'], 'role'));
    }
}

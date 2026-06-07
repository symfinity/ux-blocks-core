<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocks\Registry\CoreRoleCatalog;
use Symfony\Component\Yaml\Yaml;

final class RegistryConsistencyTest extends TestCase
{
    /** @return array<string, array{0: string}> */
    public static function coreRoleProvider(): array
    {
        $provider = [];
        foreach (CoreRoleCatalog::roles() as $role) {
            $provider[$role] = [$role];
        }

        return $provider;
    }

    #[Test]
    public function yamlSchemaVersionMatchesContract(): void
    {
        $registry = $this->loadRegistry();

        self::assertSame('1.3', $registry['ux_role_registry']);
        self::assertSame('blocks', $registry['registry_prefix']);
    }

    #[Test]
    public function yamlContainsExactlyTwentyTwoAtomRoles(): void
    {
        $registry = $this->loadRegistry();

        self::assertCount(22, $registry['roles']);
        self::assertSame(CoreRoleCatalog::roles(), array_column($registry['roles'], 'role'));
        self::assertSame('blocks.image', $this->findRole('image')['fragment_id']);
    }

    #[Test]
    #[DataProvider('coreRoleProvider')]
    public function eachRowHasRequiredFields(string $role): void
    {
        $row = $this->findRole($role);

        self::assertSame($role, $row['role']);
        self::assertNotEmpty($row['twig_component']);
        self::assertNotEmpty($row['php_class']);
        self::assertSame('blocks.' . $role, $row['fragment_id']);
        self::assertSame('blocks.' . $role . '.{n}', $row['fragment_pattern']);
        self::assertSame('A', $row['stage']);
        self::assertTrue(class_exists($row['php_class']), $row['php_class']);
    }

    /** @return array<string, mixed> */
    private function loadRegistry(): array
    {
        return Yaml::parseFile(\dirname(__DIR__, 2) . '/config/ux_roles.yaml');
    }

    /** @return array<string, mixed> */
    private function findRole(string $role): array
    {
        foreach ($this->loadRegistry()['roles'] as $row) {
            if (($row['role'] ?? null) === $role) {
                return $row;
            }
        }

        self::fail(sprintf('Role "%s" not found in ux_roles.yaml', $role));
    }
}

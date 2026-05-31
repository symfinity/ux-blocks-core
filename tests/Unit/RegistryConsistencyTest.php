<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocks\Registry\V0RoleCatalog;
use Symfony\Component\Yaml\Yaml;

final class RegistryConsistencyTest extends TestCase
{
    /** @return array<string, array{0: string}> */
    public static function v0RoleProvider(): array
    {
        $provider = [];
        foreach (V0RoleCatalog::roles() as $role) {
            $provider[$role] = [$role];
        }

        return $provider;
    }

    #[Test]
    public function yamlSchemaVersionMatchesContract(): void
    {
        $registry = $this->loadRegistry();

        self::assertSame('1.1', $registry['ux_role_registry']);
        self::assertSame('blocks', $registry['prefix']);
    }

    #[Test]
    public function yamlContainsExactlyFourteenV0Roles(): void
    {
        $registry = $this->loadRegistry();
        $v0Roles = array_values(array_filter(
            $registry['roles'],
            static fn (array $row): bool => ($row['status'] ?? '') === 'v0',
        ));

        self::assertCount(14, $v0Roles);
        self::assertSame(V0RoleCatalog::roles(), array_column($v0Roles, 'role'));
    }

    #[Test]
    #[DataProvider('v0RoleProvider')]
    public function eachV0RowHasRequiredFields(string $role): void
    {
        $row = $this->findRole($role);

        self::assertSame($role, $row['role']);
        self::assertMatchesRegularExpression('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $row['role']);
        self::assertNotEmpty($row['twig_component']);
        self::assertNotEmpty($row['php_class']);
        self::assertSame('blocks.' . $role, $row['fragment_id']);
        self::assertSame('blocks.' . $role . '.{n}', $row['fragment_pattern']);
        self::assertSame('A', $row['stage']);
        self::assertSame('v0', $row['status']);
        self::assertTrue(class_exists($row['php_class']), sprintf('Missing class %s', $row['php_class']));
    }

    /** @return array<string, mixed> */
    private function loadRegistry(): array
    {
        $path = \dirname(__DIR__, 2) . '/config/ux_roles.yaml';

        return Yaml::parseFile($path);
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

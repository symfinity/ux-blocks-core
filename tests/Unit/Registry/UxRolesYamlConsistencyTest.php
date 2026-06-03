<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

final class UxRolesYamlConsistencyTest extends TestCase
{
    /** @return list<string> */
    private static function contractRoles(): array
    {
        return [
            'button', 'separator', 'typography', 'card', 'empty', 'table', 'alert', 'label',
            'input', 'textarea', 'select', 'field', 'checkbox', 'radio-group',
            'grid', 'stack', 'skeleton', 'dialog', 'navbar', 'badge', 'avatar', 'breadcrumb',
            'pagination', 'progress', 'spinner', 'button-group', 'accordion', 'switch',
            'input-group', 'file-input', 'description-list', 'scroll-area', 'page-heading',
            'section-heading', 'popover', 'tooltip', 'auth-layout', 'dashboard-shell', 'kbd',
            'carousel', 'aspect-ratio', 'divider', 'list', 'stat', 'timeline', 'steps', 'link',
            'fieldset',
        ];
    }

    /** @return array<string, array{0: string}> */
    public static function contractRoleProvider(): array
    {
        $provider = [];
        foreach (self::contractRoles() as $role) {
            $provider[$role] = [$role];
        }

        return $provider;
    }

    #[Test]
    public function yamlSchemaMatchesContract(): void
    {
        $registry = $this->loadRegistry();

        self::assertSame('1.2', $registry['ux_role_registry']);
        self::assertSame('blocks', $registry['registry_prefix']);
    }

    #[Test]
    public function yamlContainsExactlyFortyEightRoles(): void
    {
        $registry = $this->loadRegistry();

        self::assertCount(48, $registry['roles']);
        self::assertSame(self::contractRoles(), array_column($registry['roles'], 'role'));
    }

    #[Test]
    public function v0AndV1RoleCountsMatchContract(): void
    {
        $registry = $this->loadRegistry();
        $v0 = array_values(array_filter(
            $registry['roles'],
            static fn (array $row): bool => ($row['status'] ?? '') === 'v0',
        ));
        $v1 = array_values(array_filter(
            $registry['roles'],
            static fn (array $row): bool => ($row['status'] ?? '') === 'v1',
        ));

        self::assertCount(14, $v0);
        self::assertCount(34, $v1);
    }

    #[Test]
    #[DataProvider('contractRoleProvider')]
    public function eachRoleHasBlocksFragmentId(string $role): void
    {
        $row = $this->findRole($role);

        self::assertSame('blocks.' . $role, $row['fragment_id']);
        self::assertSame('blocks.' . $role . '.{n}', $row['fragment_pattern']);
        self::assertSame('A', $row['stage']);
    }

    /** @return array<string, mixed> */
    private function loadRegistry(): array
    {
        $path = \dirname(__DIR__, 3) . '/config/ux_roles.yaml';

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

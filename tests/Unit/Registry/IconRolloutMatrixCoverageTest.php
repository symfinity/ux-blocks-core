<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

final class IconRolloutMatrixCoverageTest extends TestCase
{
    #[Test]
    public function p1RolesDeclareIconSlotMetadata(): void
    {
        $packageRoot = \dirname(__DIR__, 3);
        $expectations = [
            $packageRoot . '/config/ux_roles.yaml' => [
                'link', 'badge', 'flash', 'button',
                'page-heading', 'section-heading',
            ],
            \dirname($packageRoot) . '/ux-blocks-form/config/ux_roles.yaml' => [
                'input',
            ],
            \dirname($packageRoot) . '/ux-blocks-extended/config/ux_roles.yaml' => [
                'stat', 'navbar', 'alert', 'empty',
            ],
            \dirname($packageRoot) . '/ux-blocks-interactive/config/ux_roles.yaml' => [
                'toast', 'dropdown-menu',
            ],
        ];

        foreach ($expectations as $path => $roles) {
            self::assertFileExists($path, $path);
            $registry = Yaml::parseFile($path);
            $byRole = [];
            foreach ($registry['roles'] ?? [] as $row) {
                $byRole[$row['role']] = $row;
            }

            foreach ($roles as $role) {
                self::assertArrayHasKey($role, $byRole, sprintf('%s missing role %s', $path, $role));
                self::assertArrayHasKey(
                    'icon_slot',
                    $byRole[$role],
                    sprintf('%s role %s missing icon_slot metadata', $path, $role),
                );
            }
        }
    }
}

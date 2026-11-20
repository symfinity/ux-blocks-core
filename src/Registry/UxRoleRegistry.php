<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Registry;

use Symfinity\UxBlocks\Registry\TierCatalog;
use Symfinity\UxBlocks\Registry\UxRoleRecord;

/**
 * Role lookup over every installed tier catalogue (core first).
 *
 * The first path is the core catalogue; core-only accessors read it alone.
 */
final class UxRoleRegistry
{
    private TierCatalog $coreCatalog;

    /** @var array<string, UxRoleRecord> */
    private array $byTwigComponent = [];

    /** @var list<UxRoleRecord> */
    private array $allRoles = [];

    /**
     * @param list<string> $yamlPaths tier `config/ux_roles.yaml` files, core first
     */
    public function __construct(array $yamlPaths)
    {
        if ($yamlPaths === []) {
            throw new \InvalidArgumentException('UxRoleRegistry needs at least the core ux_roles.yaml path.');
        }

        /** @var array<string, string> $sources twig component → catalogue path */
        $sources = [];

        foreach ($yamlPaths as $index => $path) {
            $catalog = TierCatalog::fromYamlFile($path);
            if ($index === 0) {
                $this->coreCatalog = $catalog;
            }

            foreach ($catalog->roles as $role) {
                $this->allRoles[] = $role;
                if ($role->twigComponent === '') {
                    continue;
                }

                if (isset($sources[$role->twigComponent])) {
                    throw new \LogicException(\sprintf(
                        'Twig component "%s" is declared in two role catalogues: %s and %s.',
                        $role->twigComponent,
                        $sources[$role->twigComponent],
                        $path,
                    ));
                }

                $sources[$role->twigComponent] = $path;
                $this->byTwigComponent[$role->twigComponent] = $role;
            }
        }
    }

    public function findByTwigComponent(string $twigComponent): ?UxRoleRecord
    {
        return $this->byTwigComponent[$twigComponent] ?? null;
    }

    public function findCoreByTwigComponent(string $twigComponent): ?UxRoleRecord
    {
        return $this->coreCatalog->findByTwigComponent($twigComponent);
    }

    public function roleCount(): int
    {
        return \count($this->allRoles);
    }

    /**
     * @return list<string>
     */
    public function rootTwigComponents(): array
    {
        return array_map(static fn (UxRoleRecord $role) => $role->twigComponent, $this->allRoles);
    }

    /**
     * @return list<UxRoleRecord>
     */
    public function roles(): array
    {
        return $this->allRoles;
    }

    /**
     * @return list<UxRoleRecord>
     */
    public function coreRoles(): array
    {
        return $this->coreCatalog->roles;
    }
}

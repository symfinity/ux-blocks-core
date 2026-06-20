<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Registry;

use Symfinity\UxBlocks\Registry\TierCatalog;
use Symfinity\UxBlocks\Registry\UxRoleRecord;

final class UxRoleRegistry
{
    private TierCatalog $catalog;

    public function __construct(string $yamlPath)
    {
        $this->catalog = TierCatalog::fromYamlFile($yamlPath);
    }

    public function findByTwigComponent(string $twigComponent): ?UxRoleRecord
    {
        return $this->catalog->findByTwigComponent($twigComponent);
    }

    public function roleCount(): int
    {
        return $this->catalog->roleCount();
    }

    /**
     * @return list<string>
     */
    public function rootTwigComponents(): array
    {
        return array_map(static fn (UxRoleRecord $role) => $role->twigComponent, $this->catalog->roles);
    }

    /**
     * @return list<UxRoleRecord>
     */
    public function roles(): array
    {
        return $this->catalog->roles;
    }
}

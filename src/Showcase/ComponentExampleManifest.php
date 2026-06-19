<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Showcase;

final readonly class ComponentExampleManifest
{
    /**
     * @param list<array<string, mixed>> $sections
     */
    public function __construct(
        public string $role,
        public string $twigName,
        public bool $requiresStimulus,
        public array $sections,
    ) {
    }
}

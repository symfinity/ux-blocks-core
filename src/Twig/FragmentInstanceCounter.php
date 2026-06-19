<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

final class FragmentInstanceCounter
{
    /** @var array<string, int> */
    private array $counts = [];

    public function next(string $fragmentId): int
    {
        $this->counts[$fragmentId] = ($this->counts[$fragmentId] ?? 0) + 1;

        return $this->counts[$fragmentId];
    }

    public function reset(): void
    {
        $this->counts = [];
    }
}

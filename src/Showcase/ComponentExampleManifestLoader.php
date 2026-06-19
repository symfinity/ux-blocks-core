<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Showcase;

use Symfony\Component\Yaml\Yaml;

final class ComponentExampleManifestLoader
{
    public function __construct(
        private readonly string $examplesDir,
    ) {
    }

    /**
     * @return list<ComponentExampleManifest>
     */
    public function loadAll(): array
    {
        if (!is_dir($this->examplesDir)) {
            return [];
        }

        $files = glob($this->examplesDir . '/*.yaml') ?: [];
        sort($files);

        $manifests = [];
        foreach ($files as $file) {
            $manifests[] = $this->loadFile($file);
        }

        return $manifests;
    }

    public function loadRole(string $role): ?ComponentExampleManifest
    {
        $path = $this->examplesDir . '/' . $role . '.yaml';
        if (!is_file($path)) {
            return null;
        }

        return $this->loadFile($path);
    }

    private function loadFile(string $path): ComponentExampleManifest
    {
        /** @var array<string, mixed> $data */
        $data = Yaml::parseFile($path);
        $role = (string) ($data['role'] ?? basename($path, '.yaml'));
        $twigName = (string) ($data['twig_name'] ?? $this->defaultTwigName($role));
        $requiresStimulus = (bool) ($data['requires_stimulus'] ?? false);
        /** @var list<array<string, mixed>> $sections */
        $sections = is_array($data['sections'] ?? null) ? $data['sections'] : [];

        if (($data['schema'] ?? '') !== 'showcase-examples/1.0') {
            throw new \InvalidArgumentException(sprintf('Unsupported manifest schema in %s', $path));
        }

        return new ComponentExampleManifest($role, $twigName, $requiresStimulus, $sections);
    }

    private function defaultTwigName(string $role): string
    {
        return str_replace('-', '', ucwords($role, '-'));
    }
}

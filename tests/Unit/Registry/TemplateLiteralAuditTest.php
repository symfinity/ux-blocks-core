<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocksCore\Registry\UxRoleRegistry;

final class TemplateLiteralAuditTest extends TestCase
{
    private const EXCEPTION_PATHS = [
        'templates/components/Typography/',
        'templates/components/RadioGroup/',
        'templates/components/List/',
        'templates/components/Grid/',
        'templates/catalog/',
    ];

    #[Test]
    public function rootAtomTemplatesDoNotHandAuthorRegistryAttributes(): void
    {
        $packageDir = \dirname(__DIR__, 3);
        $registry = new UxRoleRegistry($packageDir . '/config/ux_roles.yaml');
        $rootTwigFiles = glob($packageDir . '/templates/components/*.html.twig') ?: [];

        $violations = [];
        foreach ($rootTwigFiles as $file) {
            $basename = basename($file, '.html.twig');
            $twigName = $this->resolveTwigName($basename, $registry);
            if (null === $twigName) {
                continue;
            }

            $content = (string) file_get_contents($file);
            if (preg_match('/data-ui-role\s*=/', $content) || preg_match('/data-ui-fragment\s*=/', $content)) {
                $violations[] = $file;
            }
        }

        self::assertSame([], $violations, 'Root atom templates must not hand-author data-ui-role/data-ui-fragment after bridge migration.');
    }

    #[Test]
    public function handLiteralCountStaysWithinWaveOneBudget(): void
    {
        $packageDir = \dirname(__DIR__, 3);
        $templatesDir = $packageDir . '/templates';
        $allFiles = $this->collectTwigFiles($templatesDir);
        $total = 0;
        $hand = 0;

        foreach ($allFiles as $file) {
            if ($this->isExceptionPath($file, $packageDir)) {
                continue;
            }

            $content = (string) file_get_contents($file);
            $total += substr_count($content, 'data-ui-role=') + substr_count($content, 'data-ui-fragment=');
            $hand += preg_match_all('/data-ui-(?:role|fragment)\s*=/', $content) ?: 0;
        }

        self::assertGreaterThan(0, $total);
        self::assertLessThanOrEqual((int) ceil($total * 0.10) + 2, $hand, 'Documented nested/catalog exceptions may retain literals.');
    }

    private function resolveTwigName(string $basename, UxRoleRegistry $registry): ?string
    {
        foreach ($registry->rootTwigComponents() as $twigComponent) {
            if (0 === strcasecmp($basename, $twigComponent)) {
                return $twigComponent;
            }
        }

        return null;
    }

    /**
     * @return list<string>
     */
    private function collectTwigFiles(string $dir): array
    {
        $files = [];
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dir));

        foreach ($iterator as $file) {
            if ($file instanceof \SplFileInfo && $file->isFile() && str_ends_with($file->getFilename(), '.twig')) {
                $files[] = $file->getPathname();
            }
        }

        return $files;
    }

    private function isExceptionPath(string $file, string $packageDir): bool
    {
        $relative = str_replace($packageDir . '/', '', $file);
        foreach (self::EXCEPTION_PATHS as $exception) {
            if (str_starts_with($relative, $exception)) {
                return true;
            }
        }

        return false;
    }
}

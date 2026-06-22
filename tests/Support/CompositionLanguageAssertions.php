<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Support;

use PHPUnit\Framework\Assert;
use Symfinity\UxBlocks\Registry\ConformanceViolation;
use Symfinity\UxBlocks\Registry\LanguageConformance;
use Symfinity\UxBlocks\Registry\RoleLanguageDefinition;

/**
 * Composition-language conformance helpers for tier registry tests.
 *
 * Local copy so split-mirror CI does not depend on {@see \Symfinity\UxBlocks\Test\ConformanceAssertions}
 * (shipped in symfinity/ux-blocks dev/main; not guaranteed on every published 0.1.x patch).
 */
trait CompositionLanguageAssertions
{
    protected function assertRoleDefinitionConformant(RoleLanguageDefinition $def): void
    {
        self::assertNoConformanceFailures(LanguageConformance::checkRoleDefinition($def), $def->role);
    }

    /**
     * @param list<string> $roleIds
     */
    protected function assertNoCompoundRoles(array $roleIds): void
    {
        self::assertNoConformanceFailures(LanguageConformance::checkNoCompoundRoles($roleIds), '(catalog)');
    }

    protected function assertRegionVocabularyClosed(): void
    {
        self::assertNoConformanceFailures(LanguageConformance::checkRegionVocabularyClosed(), '(region_vocabulary)');
    }

    /**
     * @param list<string> $emittedParts
     */
    protected function assertEmittedPartsConformant(string $role, array $emittedParts): void
    {
        self::assertNoConformanceFailures(LanguageConformance::checkEmittedParts($role, $emittedParts), $role);
    }

    /**
     * @return list<string>
     */
    protected function emittedParts(string $html): array
    {
        if (!preg_match_all('/data-ui-part="([^"]+)"/', $html, $matches)) {
            return [];
        }

        return array_values(array_unique($matches[1]));
    }

    /**
     * @param list<ConformanceViolation> $violations
     */
    private static function assertNoConformanceFailures(array $violations, string $context): void
    {
        $failures = LanguageConformance::failuresOnly($violations);

        Assert::assertSame(
            [],
            array_map(static fn (ConformanceViolation $v): string => $v->describe(), $failures),
            sprintf('Composition-language conformance failed for %s', $context),
        );
    }
}

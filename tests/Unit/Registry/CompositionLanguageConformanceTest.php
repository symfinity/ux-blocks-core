<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Registry;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfinity\UxBlocks\Registry\CompositionLanguageRegistryAuditor;
use Symfinity\UxBlocks\Registry\LanguageConformance;
use Symfinity\UxBlocks\Registry\RoleLanguageDefinition;
use Symfinity\UxBlocksCore\Tests\Support\CompositionLanguageAssertions;
use Symfony\Component\Yaml\Yaml;

/**
 * Asserts the ux-blocks-core registry conforms to the composition language.
 */
final class CompositionLanguageConformanceTest extends TestCase
{
    use CompositionLanguageAssertions;

    /**
     * @return list<array<string, mixed>>
     */
    private static function roleRows(): array
    {
        /** @var array<string, mixed> $registry */
        $registry = Yaml::parseFile(\dirname(__DIR__, 3) . '/config/ux_roles.yaml');

        /** @var list<array<string, mixed>> $rows */
        $rows = $registry['roles'] ?? [];

        return $rows;
    }

    #[Test]
    public function everyCoreRoleDefinitionIsConformant(): void
    {
        foreach (self::roleRows() as $row) {
            $def = RoleLanguageDefinition::fromRegistryRow('core', $row);
            $this->assertRoleDefinitionConformant($def);
        }
    }

    #[Test]
    public function noCoreRoleIsAPerConceptCompound(): void
    {
        $roleIds = array_map(static fn (array $row): string => (string) ($row['role'] ?? ''), self::roleRows());

        $this->assertNoCompoundRoles($roleIds);
    }

    #[Test]
    public function regionVocabularyStaysClosed(): void
    {
        $this->assertRegionVocabularyClosed();
    }

    #[Test]
    public function declaredFacetsCoverLexicalAtoms(): void
    {
        $byRole = [];
        foreach (self::roleRows() as $row) {
            $byRole[(string) ($row['role'] ?? '')] = RoleLanguageDefinition::fromRegistryRow('core', $row);
        }

        self::assertContains('variant', $byRole['button']->attributes);
        self::assertContains('icon', $byRole['button']->scalarContent);
        self::assertContains('title', $byRole['page-heading']->scalarContent);
        self::assertContains('actions', $byRole['page-heading']->styledParts);
    }

    #[Test]
    public function catalogLaneAuditPassesForCore(): void
    {
        $auditor = new CompositionLanguageRegistryAuditor();
        $failures = LanguageConformance::failuresOnly($auditor->auditLane('blocks.core'));

        self::assertSame([], array_map(static fn ($v) => $v->describe(), $failures));
    }

    #[Test]
    public function enforcedRegionTemplatesEmitClosedParts(): void
    {
        $bundlePath = dirname(__DIR__, 3);
        foreach (['Header', 'Footer', 'Media', 'Actions', 'Aside'] as $component) {
            $html = (string) file_get_contents($bundlePath . '/templates/components/' . $component . '.html.twig');
            $this->assertEmittedPartsConformant(strtolower($component), $this->emittedParts($html));
        }
    }
}

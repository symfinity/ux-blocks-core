<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Psr\Log\AbstractLogger;
use Symfinity\UxBlocksCore\Twig\Components\Badge;
use Symfinity\UxBlocksCore\Twig\Components\Button;
use Symfinity\UxBlocksCore\Twig\UnknownColourVariantListener;
use Symfony\UX\TwigComponent\ComponentMetadata;
use Symfony\UX\TwigComponent\Event\PreMountEvent;

final class UnknownColourVariantListenerTest extends TestCase
{
    #[Test]
    public function unknownVariantLogsOneWarning(): void
    {
        $logger = $this->logger();
        (new UnknownColourVariantListener($logger))->onPreMount($this->preMount(new Badge(), ['variant' => 'nope']));

        self::assertCount(1, $logger->records);
        [$level, $message] = $logger->records[0];
        self::assertSame('warning', $level);
        self::assertStringContainsString('"nope"', $message);
        self::assertStringContainsString('"primary"', $message);
        self::assertStringContainsString('danger', $message);
    }

    #[Test]
    #[DataProvider('knownValues')]
    public function knownValuesAndAliasesLogNothing(string $value): void
    {
        $logger = $this->logger();
        (new UnknownColourVariantListener($logger))->onPreMount($this->preMount(new Button(), ['variant' => $value]));

        self::assertSame([], $logger->records);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function knownValues(): iterable
    {
        yield 'vocabulary' => ['success'];
        yield 'legacy alias' => ['default'];
        yield 'legacy destructive' => ['destructive'];
        yield 'appearance alias' => ['outline'];
        yield 'link alias' => ['link'];
    }

    #[Test]
    public function componentsWithoutColourVariantsAreIgnored(): void
    {
        $logger = $this->logger();
        (new UnknownColourVariantListener($logger))->onPreMount($this->preMount(new \stdClass(), ['variant' => 'nope']));

        self::assertSame([], $logger->records);
    }

    #[Test]
    public function noLoggerMeansNoError(): void
    {
        (new UnknownColourVariantListener(null))->onPreMount($this->preMount(new Badge(), ['variant' => 'nope']));

        $this->addToAssertionCount(1);
    }

    /**
     * @param array<string, mixed> $data
     */
    private function preMount(object $component, array $data): PreMountEvent
    {
        return new PreMountEvent($component, $data, new ComponentMetadata([
            'key' => $component::class,
            'template' => 'components/component.html.twig',
        ]));
    }

    /**
     * @return AbstractLogger&object{records: list<array{string, string}>}
     */
    private function logger(): AbstractLogger
    {
        return new class extends AbstractLogger {
            /** @var list<array{string, string}> */
            public array $records = [];

            public function log($level, \Stringable|string $message, array $context = []): void
            {
                $replace = [];
                foreach ($context as $key => $value) {
                    $replace['{' . $key . '}'] = \is_scalar($value) ? (string) $value : '';
                }

                $this->records[] = [(string) $level, strtr((string) $message, $replace)];
            }
        };
    }
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use InvalidArgumentException;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

trait ResolvesHeadingLevel
{
    public int|string $level = 1;

    #[ExposeInTemplate('heading_level')]
    public function headingLevel(): int
    {
        return self::normalizeHeadingLevel($this->level);
    }

    #[ExposeInTemplate('heading_tag')]
    public function headingTag(): string
    {
        return 'h' . $this->headingLevel();
    }

    public static function normalizeHeadingLevel(int|string $level): int
    {
        if (is_string($level)) {
            $normalized = strtolower(trim($level));
            if (preg_match('/^h([1-6])$/', $normalized, $matches) === 1) {
                return (int) $matches[1];
            }

            if (is_numeric($normalized)) {
                $numeric = (int) $normalized;
                if ($numeric >= 1 && $numeric <= 6) {
                    return $numeric;
                }
            }

            throw new InvalidArgumentException(sprintf('Invalid heading level "%s"; expected h1–h6.', $level));
        }

        if ($level < 1 || $level > 6) {
            throw new InvalidArgumentException(sprintf('Invalid heading level %d; expected 1–6.', $level));
        }

        return $level;
    }
}

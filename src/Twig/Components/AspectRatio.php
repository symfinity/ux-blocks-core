<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsTwigComponent('AspectRatio', template: '@UxBlocksCore/components/AspectRatio.html.twig')]
final class AspectRatio
{
    public string $ratio = '16/9';

    #[ExposeInTemplate('ratioCss')]
    public function ratioCss(): string
    {
        if (preg_match('/^(\d+)\s*[\/:]\s*(\d+)$/', trim($this->ratio), $matches)) {
            return sprintf('%s / %s', $matches[1], $matches[2]);
        }

        return '16 / 9';
    }
}
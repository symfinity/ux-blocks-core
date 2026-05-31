<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Alert', template: '@UxBlocksCore/components/Alert.html.twig')]
final class Alert
{
    public string $variant = 'info';
}

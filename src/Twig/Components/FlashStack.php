<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('FlashStack', template: '@UxBlocksCore/components/FlashStack.html.twig')]
final class FlashStack
{
    public string $placement = 'top';
}

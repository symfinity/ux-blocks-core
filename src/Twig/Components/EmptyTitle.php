<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Empty:Title', template: '@UxBlocksCore/components/EmptyTitle.html.twig')]
final class EmptyTitle
{
}

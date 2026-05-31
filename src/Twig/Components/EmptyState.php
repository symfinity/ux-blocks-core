<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

/** PHP reserved word: class name EmptyState; Twig component remains {@see Empty}. */
#[AsTwigComponent('Empty', template: '@UxBlocksCore/components/Empty.html.twig')]
final class EmptyState
{
}

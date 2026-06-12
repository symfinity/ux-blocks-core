<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Empty:Header', template: '@UxBlocksCore/components/EmptyHeader.html.twig')]
final class EmptyHeader
{
}

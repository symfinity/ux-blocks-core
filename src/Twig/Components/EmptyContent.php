<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Empty:Content', template: '@UxBlocksCore/components/EmptyContent.html.twig')]
final class EmptyContent
{
}

<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Pagination', template: '@UxBlocksCore/components/Pagination.html.twig')]
final class Pagination
{
}
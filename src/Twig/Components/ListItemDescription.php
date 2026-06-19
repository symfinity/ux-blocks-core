<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('List:Item:Description', template: '@UxBlocksCore/components/List/Item/Description.html.twig')]
final class ListItemDescription
{
}

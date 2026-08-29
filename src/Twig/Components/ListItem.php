<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('List:Item', template: '@UxBlocksCore/components/List/Item.html.twig')]
final class ListItem
{
}

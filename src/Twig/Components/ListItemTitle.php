<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('List:Item:Title', template: '@UxBlocksCore/components/List/Item/Title.html.twig')]
final class ListItemTitle
{
}
